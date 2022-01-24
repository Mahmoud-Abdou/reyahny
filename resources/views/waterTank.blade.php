<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reyhni Simulation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        @media (min-width: 576px) {
            .jumbotron {
                padding: 1rem 2rem;
            }
        }

    </style>
</head>

<body>

    <div class="jumbotron text-center">
        <h1>Reyhni Simulation process</h1>
        <p>Please type current moment values.</p>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-sm-12 col-md-4 col-xs-12">
                <label>Water flow in</label>
                <div class="input-group mb-3">
                    <input class="form-control" value="1" onchange="excute()" type="number" placeholder="water_flow_in"
                        name="water_flow_in" id="water_flow_in">
                    <div class="input-group-append">
                        <span class="input-group-text"> m<sup>3</sup>/hr</span>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-4 col-xs-12">
                <label>Water flow out</label>
                <div class="input-group mb-3">
                    <input class="form-control" value="0.5" onchange="excute()" type="number"
                        placeholder="water_flow_out" name="water_flow_out" id="water_flow_out">
                    <div class="input-group-append">
                        <span class="input-group-text"> m<sup>3</sup>/hr</span>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-4 col-xs-12">
                <label>Water tank size</label>
                <div class="input-group mb-3">
                    <input class="form-control" value="4" onchange="excute()" type="number"
                        placeholder="water_tank_size" name="water_tank_size" id="water_tank_size">
                    <div class="input-group-append">
                        <span class="input-group-text"> m<sup>3</sup>/hr</span>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-4 col-xs-12">
                <label>Water tank max level</label>
                <div class="input-group mb-3">
                    <input class="form-control" value="4" onchange="excute()" type="number"
                        placeholder="water_tank_max_level" name="water_tank_max_level" id="water_tank_max_level">
                    <div class="input-group-append">
                        <span class="input-group-text"> m</span>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-4 col-xs-12">
                <label>Daily consumption per hour</label>
                <div class="input-group mb-3">
                    <input class="form-control" value="0.2" onchange="excute()" type="number"
                        placeholder="daily_consumption_per_hour" name="daily_consumption_per_hour"
                        id="daily_consumption_per_hour">
                    <div class="input-group-append">
                        <span class="input-group-text"> m<sup>3</sup>/hr</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-xs-12">
                <label>Last hour water level reading</label>
                <div class="input-group mb-3">
                    <input class="form-control" value="3" onchange="excute()" type="number"
                        placeholder="last_hour_water_level_reading" name="last_hour_water_level_reading"
                        id="last_hour_water_level_reading">
                    <div class="input-group-append">
                        <span class="input-group-text"> m</span>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-4 col-xs-12">
                <label>Current water level reading</label>
                <div class="input-group mb-3">
                    <input class="form-control" value="2.9" onchange="excute()" type="number"
                        placeholder="current_water_level_reading" name="current_water_level_reading"
                        id="current_water_level_reading">
                    <div class="input-group-append">
                        <span class="input-group-text"> m</span>
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-4 col-xs-12">
                <label>Water flow out daily array</label>
                <div class="input-group mb-3">
                    <input class="form-control" value='0.2,0.3,0.1,0.2,0.3,0.5' onchange="excute()" type="text"
                        placeholder="water_flow_out_daily_array" name="water_flow_out_daily_array"
                        id="water_flow_out_daily_array">

                </div>

            </div>
            <div class="col-sm-12 col-md-4 col-xs-12">
                <label>Water flow out monthly array</label>
                <div class="input-group mb-3">
                    <input class="form-control" value='0.2,0.3,0.1,0.2,0.3,0.5,0.4,0.2,0.4' onchange="excute()"
                        type="text" placeholder="water_flow_out_monthly_array" name="water_flow_out_monthly_array"
                        id="water_flow_out_monthly_array">

                </div>

            </div>

        </div>
        <div class="row text-danger" id="error_div">

        </div>
    </div>

</body>

</html>

<head>
</head>


<script>
    //0 "Water Level Condition"
    //1 "Consumption Condition"
    //2 "Expected Water Level Condition"
    var arraay = {
        0: "- Send signal to water meter to close valve + send SMS notification to user of potential tank flowter mulfuntion",
        1: "- Send notification SMS to user to check resident unit for potential leackage",
        2: "- Send signal to water meter to close valve + send SMS notification to user of potential tank leackage",
        3: "- Water out of tank larger last hour than average today",
        4: "- Today's average Consumption per hour larger than this month"
    };

    function excute() {

        $.ajax({
            url: "excute",
            method: 'post',
            data: {
                water_flow_in: $('#water_flow_in').val(),
                water_flow_out: $('#water_flow_out').val(),
                water_tank_size: $('#water_tank_size').val(),
                water_tank_max_level: $('#water_tank_max_level').val(),
                daily_consumption_per_hour: $('#daily_consumption_per_hour').val(),
                last_hour_water_level_reading: $('#last_hour_water_level_reading').val(),
                current_water_level_reading: $('#current_water_level_reading').val(),
                water_flow_out_daily_array: $('#water_flow_out_daily_array').val(),
                water_flow_out_monthly_array: $('#water_flow_out_monthly_array').val(),
                _token: "{{ csrf_token() }}",
            },
            success: function(result) {
                $('#error_div').html('');
                Object.keys(result).forEach((element) => {

                    if (result[element] != 0) {
                        // if (element == "daily_consumption_per_hour") {
                        //     $('#error_div').append('<h5>Daily average consumption:  ' + result[
                        //         element] + ' </h5>')
                        // } else if (element == "monthly_consumption_per_hour") {
                        //     $('#error_div').append('<h5>Monthly average consumption: ' + result[
                        //         element] + ' </h5>')
                        // } else {
                            $('#error_div').append('<h5> ' + arraay[result[element]] + ' </h5>')
                        // }
                    }
                });
            }
        });
    }
    excute();
</script>
