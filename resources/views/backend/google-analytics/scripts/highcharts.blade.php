<script>
    function createChart(data) {
        $('#area-visitors-and-pageviews').highcharts({
            accessibility: {
                enabled: false
            },
            xAxis: {
                categories: JSON.parse(data.categories)
            },
            yAxis: [{
                title: {
                    text: '{{ __('content.backend.google-analytics.highchart.series.visitors') }}',
                }
            }, {
                title: {
                    text: '{{ __('content.backend.google-analytics.highchart.series.pageviews') }}'
                },
                opposite: true
            }],
            series: [{
                name: '{{ __('content.backend.google-analytics.highchart.series.visitors') }}',
                data: JSON.parse(data.visitors)
            }, {
                name: '{{ __('content.backend.google-analytics.highchart.series.pageviews') }}',
                data: JSON.parse(data.pageviews)
            }]
        });
    }
</script>
