<?php
use App\Models\State;


if (!function_exists('getCoatingType')) {
    $type="harayana";
        function getCoatingType($type) {
            $coatingTypes = State::all();
            $bestMatch = null;
            $bestSimilarity = 0;

            foreach ($coatingTypes as $coating) {
                similar_text(strtolower($type), strtolower($coating->type), $percent);
                if ($percent > $bestSimilarity) {
                    $bestSimilarity = $percent;
                    $bestMatch = $coating;
                }
            }
             $bestSimilarity >= 75 ? $bestMatch->id : null;
        }
}
    $type = "harayana"; // Example input
$result = getCoatingType($type);

// Output the result
echo "The best matching state ID for '{$type}' is: " . ($result ? $result : 'No match found');