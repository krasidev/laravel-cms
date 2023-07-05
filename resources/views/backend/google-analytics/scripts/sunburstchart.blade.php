<script>
    function sunburstChart(select, name, children) {
        nv.addGraph(function() {
            var chart = nv.models.sunburstChart()
                .color(d3.scale.category20c())
                .mode('value')
                .margin({
                    top: 0,
                    right: 0,
                    bottom: 0,
                    left: 0
                });

            d3.select(select).datum([{
                "name": name,
                "children": children
            }]).call(chart);

            nv.utils.windowResize(chart.update);

            return chart;
        });
    }
</script>
