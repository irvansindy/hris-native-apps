<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="jquery.min.js"></script>
    <link href="orgchart/orgchart.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="orgchart/orgchart.js"></script>
    <script>
        $(document).ready(function() {
            // create a tree
            $("#tree-data").jOrgChart({
                chartElement: $("#tree-view"),
                nodeClicked: nodeClicked
            });

            // lighting a node in the selection
            function nodeClicked(node, type) {
                node = node || $(this);
                $('.jOrgChart .selected').removeClass('selected');
                node.addClass('selected');
            }
        });
    </script>
</head>

    <p id="box_add_training_topics" style="position: absolute;margin-top: -10px;">



<script>
    $(document).ready(function() {

        $("#box_add_training_topics").load("data.php",
            function(responseTxt, statusTxt, jqXHR) {
                if (statusTxt == "success") {
                    $("#box_add_training_topics").show();

                }
            }
        );
    });
</script>