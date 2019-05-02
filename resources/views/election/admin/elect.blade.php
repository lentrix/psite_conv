<?php

$results = \App\Election::results();
$totalVotes = \App\Election::totalVotes();

usort($results, function($a, $b) {
    return $b['votes'] - $a['votes'];
});

?>

@foreach($results as $result)

<div class="w3-row w3-padding-16">
    <div class="w3-card-2 w3-pale-green">
        <div class="w3-container"><h3>{{$result['candidate']->fullName()}}</h3></div>
        <div class="w3-light-grey">
            <div class="w3-container w3-green w3-center" style="width:{{ ( $totalVotes>0?($result['votes']/$totalVotes)*100:0) }}%">
                {{$result['votes']}}
            </div>
        </div>

    </div>
</div>

@endforeach
