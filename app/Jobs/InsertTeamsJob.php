<?php

namespace App\Jobs;

use App\Repositories\TeamRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InsertTeamsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Maximum execution time of the JOB in seconds.
     */
    public $timeout = 300;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {

            $teamRepository = app(TeamRepository::class);

            $apiUrl = config('services.balldontlie.api_url');
            $apiKey = config('services.balldontlie.api_key');

            $response = Http::withHeaders([
                'Authorization' => $apiKey,
            ])->get("$apiUrl/teams");
    
            if ($response->successful()) {
                $count = 0;
                $teams = $response->json('data');
    
                foreach ($teams as $teamData) {
                    $teamRepository::firstOrCreateTeam([
                        'name' => $teamData['name'],
                    ], $teamData);

                    $count ++;
                    if ($count % 30 === 0) {
                        Log::info("Waiting 1 minute after $count requests...");
                        sleep(60);
                    }
                }
            }else {
                Log::error('Failed to fetch teams from API', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Error InsertTeamsJob: '.$e->getMessage().' Line: '.$e->getLine());           
        }
    }
}
