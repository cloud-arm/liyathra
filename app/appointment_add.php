<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLOUD ARM</title>

    <?php
    include("head.php");
    include("../connect.php");
    date_default_timezone_set("Asia/Colombo");

    $user = $_GET['emp'];
    $cus_id = $_GET['cus'];
    $invo = $_GET['invo'];

    ?>
</head>

<body class="bg-light customer" style="overflow-y: scroll;">
    <div class="container flex my-3">
        <div class="box room-container">
            <div class="box-body room " style="padding: 30px 10px;">
                <div class="logo flex">
                    <h1>Appointment</h1>
                </div>

                <p>Please enter appointment date & time, service & service type </p>

                <form action="appointment_save.php" method="POST" style="width: 100%;">

                    <h2>Enter appointment date</h2>
                    <div class="form-group">
                        <label>Date*</label>
                        <input type="text" name="date" value="<?php echo date("Y-m-d"); ?>" autocomplete="off" required class="form-input" placeholder="YYYY-mm-dd">
                    </div>

                    <h2>Enter appointment time</h2>
                    <div class="form-group">
                        <label>Time*</label>
                        <input type="text" name="time"  value="<?php echo date("H:i"); ?>" autocomplete="off" required class="form-input" placeholder="HH:mm">
                    </div>

                    <h2>Click service type here</h2>
                    <div class="form-group">
                        <div class="service-type">

                            <label for="type1">
                                <input type="radio" name="type" onclick="click_type(1)" class="type" id="type1" value="1" checked />
                                <svg viewBox="0 0 24 24">
                                    <path d="M12,10.11C13.03,10.11 13.87,10.95 13.87,12C13.87,13 13.03,13.85 12,13.85C10.97,13.85 10.13,13 10.13,12C10.13,10.95 10.97,10.11 12,10.11M7.37,20C8,20.38 9.38,19.8 10.97,18.3C10.45,17.71 9.94,17.07 9.46,16.4C8.64,16.32 7.83,16.2 7.06,16.04C6.55,18.18 6.74,19.65 7.37,20M8.08,14.26L7.79,13.75C7.68,14.04 7.57,14.33 7.5,14.61C7.77,14.67 8.07,14.72 8.38,14.77C8.28,14.6 8.18,14.43 8.08,14.26M14.62,13.5L15.43,12L14.62,10.5C14.32,9.97 14,9.5 13.71,9.03C13.17,9 12.6,9 12,9C11.4,9 10.83,9 10.29,9.03C10,9.5 9.68,9.97 9.38,10.5L8.57,12L9.38,13.5C9.68,14.03 10,14.5 10.29,14.97C10.83,15 11.4,15 12,15C12.6,15 13.17,15 13.71,14.97C14,14.5 14.32,14.03 14.62,13.5M12,6.78C11.81,7 11.61,7.23 11.41,7.5C11.61,7.5 11.8,7.5 12,7.5C12.2,7.5 12.39,7.5 12.59,7.5C12.39,7.23 12.19,7 12,6.78M12,17.22C12.19,17 12.39,16.77 12.59,16.5C12.39,16.5 12.2,16.5 12,16.5C11.8,16.5 11.61,16.5 11.41,16.5C11.61,16.77 11.81,17 12,17.22M16.62,4C16,3.62 14.62,4.2 13.03,5.7C13.55,6.29 14.06,6.93 14.54,7.6C15.36,7.68 16.17,7.8 16.94,7.96C17.45,5.82 17.26,4.35 16.62,4M15.92,9.74L16.21,10.25C16.32,9.96 16.43,9.67 16.5,9.39C16.23,9.33 15.93,9.28 15.62,9.23C15.72,9.4 15.82,9.57 15.92,9.74M17.37,2.69C18.84,3.53 19,5.74 18.38,8.32C20.92,9.07 22.75,10.31 22.75,12C22.75,13.69 20.92,14.93 18.38,15.68C19,18.26 18.84,20.47 17.37,21.31C15.91,22.15 13.92,21.19 12,19.36C10.08,21.19 8.09,22.15 6.62,21.31C5.16,20.47 5,18.26 5.62,15.68C3.08,14.93 1.25,13.69 1.25,12C1.25,10.31 3.08,9.07 5.62,8.32C5,5.74 5.16,3.53 6.62,2.69C8.09,1.85 10.08,2.81 12,4.64C13.92,2.81 15.91,1.85 17.37,2.69M17.08,12C17.42,12.75 17.72,13.5 17.97,14.26C20.07,13.63 21.25,12.73 21.25,12C21.25,11.27 20.07,10.37 17.97,9.74C17.72,10.5 17.42,11.25 17.08,12M6.92,12C6.58,11.25 6.28,10.5 6.03,9.74C3.93,10.37 2.75,11.27 2.75,12C2.75,12.73 3.93,13.63 6.03,14.26C6.28,13.5 6.58,12.75 6.92,12M15.92,14.26C15.82,14.43 15.72,14.6 15.62,14.77C15.93,14.72 16.23,14.67 16.5,14.61C16.43,14.33 16.32,14.04 16.21,13.75L15.92,14.26M13.03,18.3C14.62,19.8 16,20.38 16.62,20C17.26,19.65 17.45,18.18 16.94,16.04C16.17,16.2 15.36,16.32 14.54,16.4C14.06,17.07 13.55,17.71 13.03,18.3M8.08,9.74C8.18,9.57 8.28,9.4 8.38,9.23C8.07,9.28 7.77,9.33 7.5,9.39C7.57,9.67 7.68,9.96 7.79,10.25L8.08,9.74M10.97,5.7C9.38,4.2 8,3.62 7.37,4C6.74,4.35 6.55,5.82 7.06,7.96C7.83,7.8 8.64,7.68 9.46,7.6C9.94,6.93 10.45,6.29 10.97,5.7Z" />
                                </svg>
                            </label>

                            <label for="type2">
                                <input type="radio" name="type" onclick="click_type(2)" class="type" id="type2" value="2" />
                                <svg viewBox="0 0 24 24">
                                    <path d="M2,3H5.5L12,15L18.5,3H22L12,21L2,3M6.5,3H9.5L12,7.58L14.5,3H17.5L12,13.08L6.5,3Z" />
                                </svg>
                            </label>

                            <label for="type3">
                                <input type="radio" name="type" onclick="click_type(3)" class="type" id="type3" value="3" />
                                <svg viewBox="0 0 24 24">
                                    <path d="M3,3H21V21H3V3M7.73,18.04C8.13,18.89 8.92,19.59 10.27,19.59C11.77,19.59 12.8,18.79 12.8,17.04V11.26H11.1V17C11.1,17.86 10.75,18.08 10.2,18.08C9.62,18.08 9.38,17.68 9.11,17.21L7.73,18.04M13.71,17.86C14.21,18.84 15.22,19.59 16.8,19.59C18.4,19.59 19.6,18.76 19.6,17.23C19.6,15.82 18.79,15.19 17.35,14.57L16.93,14.39C16.2,14.08 15.89,13.87 15.89,13.37C15.89,12.96 16.2,12.64 16.7,12.64C17.18,12.64 17.5,12.85 17.79,13.37L19.1,12.5C18.55,11.54 17.77,11.17 16.7,11.17C15.19,11.17 14.22,12.13 14.22,13.4C14.22,14.78 15.03,15.43 16.25,15.95L16.67,16.13C17.45,16.47 17.91,16.68 17.91,17.26C17.91,17.74 17.46,18.09 16.76,18.09C15.93,18.09 15.45,17.66 15.09,17.06L13.71,17.86Z" />
                                </svg>
                            </label>
                        </div>
                    </div>

                    <h2>Select service</h2>
                    <div class="form-group">
                        <label>Service*</label>
                        <select name="service" class="form-input" id="serve1">
                            <?php
                            $result = $db->prepare('SELECT * FROM product WHERE job_type = 1 ');
                            $result->bindParam(':id', $res);
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                <option value="<?php echo $row['product_id']  ?>">
                                    <?php echo  $row['name'];  ?></option>
                            <?php } ?>
                        </select>
                        <select name="service" class="form-input d-none" disabled id="serve2">
                            <?php
                            $result = $db->prepare('SELECT * FROM product WHERE job_type = 2 ');
                            $result->bindParam(':id', $res);
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                <option value="<?php echo $row['product_id']  ?>">
                                    <?php echo  $row['name'];  ?></option>
                            <?php } ?>
                        </select>
                        <select name="service" class="form-input d-none" disabled id="serve3">
                            <?php
                            $result = $db->prepare('SELECT * FROM product WHERE job_type = 3 ');
                            $result->bindParam(':id', $res);
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                <option value="<?php echo $row['product_id']  ?>">
                                    <?php echo  $row['name'];  ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <h2>Enter customer agree price</h2>
                    <div class="form-group">
                        <label>Price*</label>
                        <input type="number" id="price" name="price" step=".01" value="0.00" autocomplete="off" required class="form-input">
                    </div>

                    <h2>Enter special note</h2>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea name="note" class="form-input" id="" autocomplete="off"></textarea>
                    </div>

                    <div class="form-group" style="margin-top: 50px;">
                        <input type="submit" id="btn" class="form-input" value="Continue">
                        <input type="hidden" name="emp" value="<?php echo $user; ?>">
                        <input type="hidden" name="cus" value="<?php echo $cus_id; ?>">
                        <input type="hidden" name="invo" value="<?php echo $invo; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function click_type(type) {
            $('select[name="service"]').attr('disabled', '');
            $('select[name="service"]').addClass('d-none');

            $('#serve' + type).removeAttr('disabled');
            $('#serve' + type).removeClass('d-none');
        }

        function checking() {

            let count = $('#mobile').val().length;
            var val = $('#mobile').val();

            if (count >= 10) {
                $('#mobile').attr('readonly', '');
            } else {
                $('#mobile').removeAttr('readonly');
            }

            if (val.charAt(0) == 0 && val.charAt(1) == 7) {
                $('#mobile').css('outline', '2px solid rgb(var(--bg-theme))');
            } else {
                $('#mobile').css('outline', '2px solid red');
            }

            if (event.which == 8) {
                $($('#mobile')).val(
                    function(index, value) {
                        return value.substr(0, value.length - 1);
                    })
            }
        }
        $(document).ready(function() {
            $("#price").on("focus", function() {
                $(this).select();
            });
        });
    </script>
</body>

</html>