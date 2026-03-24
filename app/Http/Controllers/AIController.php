<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patent;
use App\Models\Trademark;

class AIController extends Controller
{
    public function similarity()
    {
        return view('ai.similarity');
    }

    public function checkSimilarity(Request $request)
    {
        $validated = $request->validate([
            'query_text' => 'required|string|min:10',
            'type' => 'required|in:patent,trademark'
        ]);

        $query = $validated['query_text'];
        $type = $validated['type'];

        // Mock AI Similarity Algorithm utilizing basic text matching and percentage generation.
        // In a real scenario, we would use Elasticsearch, Pinecone, or an OpenAI Embedding Vector Search.
        
        $results = [];
        if ($type === 'patent') {
            $records = Patent::all();
            foreach ($records as $record) {
                // Calculate simulated similarity score using string similarity algorithms
                similar_text(strtolower($query), strtolower($record->title . ' ' . $record->description), $percent);
                // Add some random noise to simulate 'deep analysis' match likelihoods if there is some baseline match
                $score = min(100, max(0, round($percent * 1.5 + (strlen($query) > 50 ? rand(5,15) : 0))));
                
                if ($score > 15) { // Only return somewhat relevant matches
                    $results[] = [
                        'id' => $record->id,
                        'title' => $record->title,
                        'abstract' => substr($record->description, 0, 150) . '...',
                        'similarity_score' => $score,
                        'status' => $record->status,
                        'type' => 'Patent'
                    ];
                }
            }
        } else {
            $records = Trademark::all();
            foreach ($records as $record) {
                similar_text(strtolower($query), strtolower($record->name . ' ' . $record->description), $percent);
                $score = min(100, max(0, round($percent * 1.8)));
                
                if ($score > 15) {
                    $results[] = [
                        'id' => $record->id,
                        'title' => $record->name,
                        'abstract' => substr($record->description, 0, 150) . '...',
                        'similarity_score' => $score,
                        'status' => $record->status,
                        'type' => 'Trademark'
                    ];
                }
            }
        }

        // Sort descending by score
        usort($results, function($a, $b) {
            return $b['similarity_score'] <=> $a['similarity_score'];
        });

        // Limit to top 5 matches
        $results = array_slice($results, 0, 5);

        return view('ai.similarity', [
            'results' => $results,
            'query_text' => $query,
            'search_type' => $type
        ]);
    }
}
