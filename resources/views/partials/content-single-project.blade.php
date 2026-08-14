<x-page-banner :hero="$hero" />
@include('sections.project-details', ['data' => $project_details])

@foreach ($sections as $section)
    @php
        $acf_fc_layout = $section['acf_fc_layout'];
    @endphp
    @include($sections_templates[$acf_fc_layout], ['data' => $section])
@endforeach
