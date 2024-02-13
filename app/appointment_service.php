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

    $invo = $_GET['invo'];
    $result = $db->prepare("SELECT * FROM job WHERE invoice_no = '$invo' ");
    $result->bindParam(':id', $res);
    $result->execute();
    for ($i = 0; $row = $result->fetch(); $i++) {
        $job = $row['id'];
    }
    ?>
</head>

<body class="bg-light customer" style="--bg-background: 131, 109, 130; overflow-y: scroll;">

    <div class="container-fluid container-md mt-4">
        <div class="box px-2 mb-0 mt-3 ">
            <div class="box-header px-0 mb-0">
                <a class="nav-link border-0 btn fs-1 d-md-none" style="visibility: hidden;" aria-current="page" href="index.php"><i class="fa-solid fa-house"></i></a>
                <a class="nav-link border-0 btn fs-1 d-md-none" aria-current="page" href="appointment_data.php?id=<?php echo $job ?>"><i class="fa-solid fa-table"></i></a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" style="visibility: hidden;" aria-current="page" href="index.php"><i class="fa-solid fa-house me-2"></i>Home</a>
                <a class="nav-link btn border-0 bg-theme px-3 fs-4 py-2 d-none d-md-block" aria-current="page" href="appointment_data.php?id=<?php echo $job ?>"><i class="fa-solid fa-table me-2"></i></i>Details</a>
            </div>
        </div>
    </div>

    <div class="container-fluid down-up" id="down-up" style="transform: translateY(101%);">
        <div id="container" onclick="containerDown()"></div>
        <div class="up-content">
            <span class="closer"></span>
            <div class="content">
                <div class="cont-box ">
                    <h5 class="top" id="top"></h5>
                    <h6 class="sub-top" id="sub-top"></h6>
                    <input type="hidden" id="p_id" value="">
                </div>
                <div class="cont-box">
                    <h6>Enter customer agree price</h5>
                        <input type="number" id="price" step=".01" onkeyup="check()" placeholder="0.00" autocomplete="off" class="form-input w-100 ">
                </div>
                <button disabled class="btn" id="odr_btn" onclick="sales_add_list()">Order Now</button>
            </div>
        </div>
    </div>

    <div class="container-lg box-body category room" style="flex-direction: column; gap: 10px;" id="sales_list"></div>

    <div class="container-lg box-body category mt-5 room-container" style="overflow-x: scroll;">
        <table>
            <tr>
                <td>
                    <label for="type1" class="room">
                        <input type="radio" name="type" class=" cat_fill type" id="type1" value="1" checked />
                        <svg version="1.0" id="hair" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 639.82 794.73" style="enable-background:new 0 0 639.82 794.73;" xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill: #FCFEFD;
                                }
                            </style>
                            <path d="M359.81,85.01c-0.69-0.83-0.79-0.76-0.28,0.19c24.22,45.7,60.59,82.56,113.45,91.56c25.91,4.41,54.97-4.31,69.33-27.22
                                        c6.56-10.47,9.09-22.66,6.97-34.78c-0.19-1.09-0.03-1.15,0.5-0.18c18.74,34.56,8.71,78.51-31.29,91.65
                                        c-24.49,8.05-53.91,4.89-78.74-3.58c-30.63-10.46-57.13-27.35-79.52-50.68c-11.15-11.63-21.09-23.61-29.81-35.94
                                        c-20.51-29-40.33-57.95-76.45-67.77c-7.16-1.95-14.11-3.47-20.84-4.58c-2.33-0.38-2.4-0.12-0.22,0.78
                                        c19.96,8.27,38.55,23.55,51.76,40.08c15.19,19.01,27.02,41.66,39.71,62.78c6.61,11.01,15.36,22.52,26.24,34.52
                                        c23.05,25.43,53.69,42.54,88.11,46.78c19.93,2.45,41.22,1.74,60.22-4.26c5.56-1.76,11.34-4.39,17.33-7.9c0.01-0.01,0.03,0,0.04,0.01
                                        l0.13,0.22c0.09,0.14,0.06,0.26-0.08,0.35c-7.57,4.92-15.43,10.36-23.11,14.18c-31.77,15.79-67.24,21.49-102.3,14.61
                                        c-44.05-8.64-77.47-35.11-103.38-70.71c-19.69-27.04-34.18-60.25-57.42-85.54c-9.73-10.59-19.64-18.78-29.73-24.57
                                        c-7.38-4.23-16.56-7.47-27.54-9.7c-0.1-0.02-0.19-0.06-0.26-0.12c-0.17-0.14-0.31-0.15-0.42-0.02c-0.12,0.13-0.08,0.33,0.08,0.41
                                        c32.01,15.6,55.56,49.57,70.82,80.58c5.09,10.33,10.32,20.6,15.69,30.79c9.91,18.78,22.15,35.1,36.73,48.97
                                        c27.97,26.61,67.74,39.3,105.94,40.24c0.36,0.01,0.67,0.27,0.73,0.62c3.33,17.58,8.41,34.72,15.26,51.43
                                        c12.51,30.51,35.24,61.19,65.18,76.12c22.12,11.03,48.42,13.18,72.09,6.05c3.44-1.04,6.87-2.13,10.29-3.26
                                        c0.31-0.1,0.6-0.07,0.89,0.08c2.48,1.34,6.12,3.22,10.93,5.65c26.77,13.54,44.47,38.88,45.65,69.12
                                        c0.63,16.18-1.92,32.06-7.63,47.63c-2.42,6.57-6.11,13.59-9.41,20.27c-0.01,0.01-0.01,0.02-0.02,0.01
                                        c-0.11-0.02-0.19-0.03-0.25-0.04c-0.07-0.01-0.09-0.04-0.08-0.1c6.88-26.19-1.83-60.88-18.75-81.57
                                        c-12.92-15.79-32.57-26.24-53.12-27.56c-4.45-0.29-8.81-0.55-13.07-0.78c-0.29-0.01-0.42,0.37-0.17,0.53
                                        c25.71,16.71,51.83,45.75,57.41,76.92c0.58,3.23,1.14,6.45,1.68,9.68c0.06,0.39,0.02,0.71-0.13,0.97c-0.11,0.19-0.39,0.18-0.48-0.03
                                        c-1.52-3.65-3.27-7.12-5.26-10.41c-11.87-19.64-27.1-36-45.67-49.09c-10.53-7.42-22.2-15.25-35-23.48
                                        c-1.83-1.17-4.38-3.51-7.67-7.02c-0.05-0.04-0.09-0.04-0.13,0l-0.2,0.17c-0.15,0.12-0.17,0.34-0.06,0.49
                                        c4.2,5.53,8.32,11.12,12.37,16.79c25.59,35.88,65.88,59.59,86.85,98.98c20.87,39.21,11.26,85.44-20.63,115.48
                                        c-0.1,0.1-0.26,0.1-0.37,0l-0.21-0.19c-0.11-0.09-0.12-0.18-0.03-0.29c10.61-13.85,12.38-35.42,9.72-51.86
                                        c-5.24-32.41-23.6-56.23-47.03-77.91c-13.2-12.21-26.36-24.48-39.47-36.79c-2.09-1.96-4.18-4.6-6.37-6.59
                                        c-1.06-0.96-1.24-0.82-0.53,0.42c8.3,14.56,19.59,26.82,30.51,39.57c15.83,18.48,27.9,38.89,31.22,63.4
                                        c0.48,3.6,1.39,6.97,2.04,10.31c0.33,1.71,0.09,1.8-0.74,0.26c-0.6-1.13-1.44-2.47-2.52-4c-10.98-15.57-25.06-25.62-41.56-34.62
                                        c-6.6-3.6-14.69-6.6-22-10.17c-0.52-0.25-0.62-0.14-0.29,0.34c3.6,5.28,7.59,10.23,11.98,14.84
                                        c28.44,29.86,61.79,58.38,49.86,106.21c-0.93,3.73-2.76,8.16-4.02,12.25c-0.09,0.29-0.28,0.4-0.58,0.33l-0.27-0.06
                                        c-0.13-0.03-0.18-0.11-0.15-0.23c0.53-2.94,0.78-4.96,0.75-6.06c-0.62-28.19-11.19-51.71-31.7-70.58
                                        c-17.43-16.03-38.45-27.52-60.57-43.69c-35.92-26.26-63.78-66.59-70.42-111.2c-0.03-0.15-0.12-0.23-0.28-0.22h-0.01
                                        c-0.15,0.01-0.23,0.1-0.24,0.26c-0.79,47.15,20.03,91.84,55.56,122.55c7.75,6.69,15.86,12.92,24.33,18.68
                                        c18.44,12.53,37.84,26.67,49.24,46.37c9.18,15.86,12.42,34.13,9.38,52.27c-3.95,23.58-18.04,46.78-38.11,60.27
                                        c-3.69,2.47-7.41,4.89-11.18,7.25c-0.51,0.31-1.07,0.49-1.68,0.52c-0.35,0.02-0.38-0.08-0.11-0.29
                                        c10.8-8.45,18.82-25.33,21.08-37.68c3.04-16.68,1.29-34.32-6.73-49.39c-0.12-0.22-0.39-0.31-0.62-0.2
                                        c-3.33,1.58-6.53,3.23-9.62,4.95c-31.95,17.8-62.88,37.55-91.92,59.84c-0.16,0.12-0.4,0.1-0.54-0.05
                                        c-20.55-22.03-44.61-41.72-70.66-55.86c-8.62-4.67-18.98-9.44-31.07-14.29c-18.86-7.56-35.49-13.24-49.9-17.03
                                        c-42.27-11.14-83.04-24.46-121.35-45.44c-13.27-7.26-26.19-15.08-38.78-23.47c-3.44-2.29-6.59-4.68-9.46-7.17
                                        c-0.51-0.44-0.57-0.38-0.18,0.17c22.91,33.1,59.62,57.95,95.55,74.84c35.41,16.64,59.04,28.03,70.91,34.16
                                        c20.57,10.64,39.79,21.68,57.76,34.43c21.12,14.99,40.58,33.3,57.87,52.54c0.34,0.37,0.28,0.67-0.18,0.88l-0.81,0.37
                                        c-0.31,0.15-0.6,0.34-0.85,0.58c-10.01,9.44-19.79,19.11-29.34,29.01c-0.7,0.73-1.28,1.45-1.74,2.16c-0.16,0.26-0.53,0.3-0.74,0.08
                                        c-54.78-56.46-126.13-90.77-194.64-126.91c-11.1-5.86-24.85-13.87-41.24-24.02c-20.78-12.87-40.86-27.38-58.54-44.32
                                        c-0.31-0.3-0.49-0.67-0.52-1.11c-3.67-49.05,0.69-106.02,58.54-120.22c6.27-1.54,13.11-2.73,20.51-3.58
                                        c14.84-1.69,29.67-3.5,44.48-5.41c16.81-2.17,31.48-5.29,44-9.34c18.33-5.94,37.81-16.74,50.91-31.4c0.17-0.19,0.25-0.45,0.21-0.71
                                        l-8.18-56.15c-0.04-0.28-0.28-0.49-0.56-0.48c-1.22,0.01-2.5,0.1-3.84,0.28c-9.85,1.28-19.71,2.54-29.56,3.79
                                        c-5.18,0.65-9.51,0.97-12.98,0.96c-13.15-0.03-29.45-8.8-26.43-24.49c0.67-3.49,1.32-7,1.94-10.51c1.9-10.76-10.47-11.04-9.49-21.04
                                        c0.32-3.32,2.72-6.15,4.68-8.95c0.21-0.31,0.15-0.55-0.19-0.72c-2.91-1.45-5.14-3.56-6.68-6.34c-3.8-6.84,1.58-9.98,3.37-14.77
                                        c1.47-3.93,0.35-7.2-3.38-9.8c-6.51-4.53-24.27-14.99-15.67-24.95c8.57-9.91,16.3-20.44,23.2-31.59c3.9-6.3,8.88-16.22,8.61-23.73
                                        c-0.01-0.32-0.14-0.59-0.37-0.8c-18.27-17.16-27.65-39.29-25.16-64.05c2.06-20.55,11.21-37.55,27.46-51.02
                                        c1.42-1.18,3.55-2.36,4.84-3.47c1.77-1.54,1.6-1.81-0.52-0.8c-28.95,13.75-45.59,44.22-42.26,76.45c0.35,3.4,1.35,7.5,1.91,11.22
                                        c0.09,0.61,0.01,0.63-0.25,0.07c-26.72-57,11.45-126.33,76.83-125.67c0.31,0,0.61-0.13,0.82-0.35c6.59-6.93,12.49-13.6,20.07-19.54
                                        c26.36-20.65,63.04-26.43,95.01-16.13c5.43,1.75,11.53,4.41,18.3,7.98c20.36,10.73,38.51,25.18,55.46,40.51
                                        c0.53,0.49,0.6,0.43,0.2-0.17c-13.75-20.63-31.58-36.78-53.47-48.45c-0.28-0.15-0.18-0.57,0.14-0.57c3.39,0,6.91-0.09,10.55-0.27
                                        C387,1.39,436.73,28.53,466.84,71.1c20.19,28.54,29.06,60.42,26.61,95.64c-0.02,0.25-0.16,0.38-0.41,0.37l-8.88-0.21
                                        c-0.45-0.01-0.77-0.23-0.95-0.64c-15.88-35.78-38.59-64.88-71.48-86.48c-14.17-9.3-29.75-18.83-43.28-26.7
                                        c-35.02-20.36-75.01-35.49-115.6-23.45c-6.28,1.86-13.31,5.13-19.71,7.9c-1.19,0.51-1.13,0.73,0.16,0.65
                                        c51.44-3.24,104.19,11.39,144.05,44.19c19.61,16.14,36.42,34.9,50.42,56.28c3.46,5.29,6.83,10.41,10.1,15.36
                                        c0.67,1.03,0.49,1.21-0.54,0.56c-9.05-5.7-17.65-11.19-26.31-18.86c-8.99-7.96-17.47-16.72-25.99-25.23
                                        C379.26,104.71,367.52,94.19,359.81,85.01z M291.83,313.19c0.19,0.03,0.27,0.15,0.25,0.34c-2.88,23.22-18.55,38.83-33.64,56.14
                                        c-6.13,7.03-9.93,14.54-11.39,22.54c-1.16,6.35-1.84,10.94-2.04,13.76c-1.57,22.26-1.86,44.1-0.86,65.51
                                        c0.6,12.84,2.25,25.91,4.94,39.21c0.09,0.42-0.02,0.48-0.31,0.17c-12.93-13.52-20.11-30.89-24.27-48.86
                                        c-0.09-0.39-0.3-0.46-0.62-0.22c-35.43,26.9-81.49,30.96-124.67,37.25c-16.96,2.48-40.2,6.48-49.22,22.66
                                        c-0.38,0.68-0.55,1.48-0.51,2.39c0.21,5.08,16.67,16.04,21.42,19.18c25.36,16.77,52.93,29.95,81.35,40.6
                                        c16.09,6.03,32.36,11.56,48.8,16.57c21.67,6.61,43.12,13.83,64.37,21.66c20.11,7.41,39.61,16.12,58.5,26.11
                                        c0.11,0.06,0.24,0.05,0.35-0.01c23.17-14.99,47.05-28.52,71.64-40.58c3.15-1.55,6.27-3.19,9.36-4.94c0.17-0.09,0.19-0.32,0.04-0.45
                                        c-5.43-4.69-10.82-9.51-16.16-14.44c-18.81-17.35-33.46-37.58-43.96-60.68c-21.4-47.1-18.7-99.76,4-146.03
                                        c2.22-4.53,4.53-8.97,6.93-13.31c0.26-0.48,0.2-1.06-0.14-1.48c-17.69-21.46-24.6-45.65-29.41-72.55c-0.03-0.17-0.12-0.28-0.26-0.35
                                        c-0.12-0.06-0.26,0.03-0.26,0.16c-1.14,42.46-14.57,82.83-37.33,118.47c-0.05,0.09-0.13,0.11-0.22,0.06h-0.01
                                        c-0.09-0.05-0.11-0.13-0.07-0.22c3.15-6.99,5.69-14.19,7.64-21.62c7.03-26.85,11.48-54.58,10.85-82.51
                                        c-0.22-10.21-1.66-24.43-10.33-30.96c-2.48-1.87-2.32-2.13,0.48-0.8c1.75,0.83,4.31,1.06,7.66,0.67
                                        c9.78-1.13,17.37-5.31,22.93-13.48c0.17-0.25,0.03-0.59-0.27-0.64c-28.16-4.58-54.8-22-73.39-43.04
                                        c-13.2-14.93-24.19-31.34-32.97-49.24c-10.2-20.78-19.53-41.41-31.96-61.03c-0.18-0.28-0.58-0.32-0.81-0.08
                                        c-10.69,11.17-18.31,24.19-22.87,39.06c-5,16.31-5.49,30.23-6.67,49.85c-0.33,5.5-1.16,12.26-2.95,16.49
                                        c-6.79,15.94-17.91,32.36-31.18,44.48c-0.24,0.22-0.25,0.45-0.02,0.69c6.56,6.9,16.85,8.45,21.78,17.27
                                        c0.49,0.87-0.04,1.96-1.02,2.12c-2.65,0.45-5.26,0.3-7.82-0.44c-1.11-0.32-1.28-0.06-0.49,0.79c3.3,3.56,5.43,12.04,0.16,15.27
                                        c-0.3,0.19-0.29,0.64,0.02,0.81c8.37,4.6,16.4,9.72,24.11,15.36c0.32,0.23,0.31,0.71-0.02,0.93c-5.41,3.68-13.11,1.29-17.59,6.64
                                        c-0.92,1.1-0.75,2.74,0.38,3.63c5.47,4.29,9.77,7.79,8.59,15.65c-0.58,3.86-1.73,8.46-1.66,11.37c0.25,10.4,10.96,12.77,19.49,11.64
                                        c13.51-1.79,28.33-4.47,44.48-8.04c20.74-4.58,70.79-14.15,76.54-39.5c0.01-0.03,0.03-0.05,0.06-0.04L291.83,313.19z M415.64,363.49
                                        c-10.81,48.69-0.57,95.42,33.64,131.96c24.5,26.18,56.91,42.65,80.61,69.62c3.09,3.51,5.69,7.64,7.82,12.41
                                        c0.07,0.15,0.18,0.2,0.33,0.13l0.24-0.1c0.05-0.02,0.07-0.06,0.05-0.11c-7.18-19.24-21.78-37.92-36.07-52.45
                                        c-7.56-7.69-15.18-15.32-22.87-22.87c-36.63-36.01-62.72-86.4-63.21-138.53C416.17,361.97,415.99,361.95,415.64,363.49z
                                        M390.96,671.24c1.67-1.24,3.12-2.95,4.52-4.11c17.08-14.06,32.61-23.39,49.91-33.94c0.48-0.3,0.54-0.98,0.11-1.35l-8.58-7.46
                                        c-0.6-0.53-1.47-0.63-2.19-0.26c-26.08,13.47-52.19,27.85-76.77,44.01c-0.28,0.18-0.29,0.58-0.02,0.79l23.6,17.99
                                        c0.33,0.25,0.78,0.28,1.14,0.06c7.26-4.43,14.48-8.99,21.66-13.66c12-7.82,29.46-17.64,52.38-29.46c0.63-0.33,0.7-0.74,0.2-1.25
                                        l-3.49-3.49c-0.48-0.48-1.02-0.56-1.61-0.23c-4.06,2.27-8.82,4.29-12.6,6.31c-16.13,8.62-32.19,16.59-48.17,26.19
                                        C390.06,671.98,390.03,671.93,390.96,671.24z" />
                            <path class="st0" d="M291.52,313.19c-5.75,25.35-55.8,34.92-76.54,39.5c-16.15,3.57-30.97,6.25-44.48,8.04
                                        c-8.53,1.13-19.24-1.24-19.49-11.64c-0.07-2.91,1.08-7.51,1.66-11.37c1.18-7.86-3.12-11.36-8.59-15.65
                                        c-1.13-0.89-1.3-2.53-0.38-3.63c4.48-5.35,12.18-2.96,17.59-6.64c0.33-0.22,0.34-0.7,0.02-0.93c-7.71-5.64-15.74-10.76-24.11-15.36
                                        c-0.31-0.17-0.32-0.62-0.02-0.81c5.27-3.23,3.14-11.71-0.16-15.27c-0.79-0.85-0.62-1.11,0.49-0.79c2.56,0.74,5.17,0.89,7.82,0.44
                                        c0.98-0.16,1.51-1.25,1.02-2.12c-4.93-8.82-15.22-10.37-21.78-17.27c-0.23-0.24-0.22-0.47,0.02-0.69
                                        c13.27-12.12,24.39-28.54,31.18-44.48c1.79-4.23,2.62-10.99,2.95-16.49c1.18-19.62,1.67-33.54,6.67-49.85
                                        c4.56-14.87,12.18-27.89,22.87-39.06c0.23-0.24,0.63-0.2,0.81,0.08c12.43,19.62,21.76,40.25,31.96,61.03
                                        c8.78,17.9,19.77,34.31,32.97,49.24c18.59,21.04,45.23,38.46,73.39,43.04c0.3,0.05,0.44,0.39,0.27,0.64
                                        c-5.56,8.17-13.15,12.35-22.93,13.48c-3.35,0.39-5.91,0.16-7.66-0.67c-2.8-1.33-2.96-1.07-0.48,0.8
                                        c8.67,6.53,10.11,20.75,10.33,30.96c0.63,27.93-3.82,55.66-10.85,82.51c-1.95,7.43-4.49,14.63-7.64,21.62
                                        c-0.04,0.09-0.02,0.17,0.07,0.22h0.01c0.09,0.05,0.17,0.03,0.22-0.06c22.76-35.64,36.19-76.01,37.33-118.47
                                        c0-0.13,0.14-0.22,0.26-0.16c0.14,0.07,0.23,0.18,0.26,0.35c4.81,26.9,11.72,51.09,29.41,72.55c0.34,0.42,0.4,1,0.14,1.48
                                        c-2.4,4.34-4.71,8.78-6.93,13.31c-22.7,46.27-25.4,98.93-4,146.03c10.5,23.1,25.15,43.33,43.96,60.68
                                        c5.34,4.93,10.73,9.75,16.16,14.44c0.15,0.13,0.13,0.36-0.04,0.45c-3.09,1.75-6.21,3.39-9.36,4.94
                                        c-24.59,12.06-48.47,25.59-71.64,40.58c-0.11,0.06-0.24,0.07-0.35,0.01c-18.89-9.99-38.39-18.7-58.5-26.11
                                        c-21.25-7.83-42.7-15.05-64.37-21.66c-16.44-5.01-32.71-10.54-48.8-16.57c-28.42-10.65-55.99-23.83-81.35-40.6
                                        c-4.75-3.14-21.21-14.1-21.42-19.18c-0.04-0.91,0.13-1.71,0.51-2.39c9.02-16.18,32.26-20.18,49.22-22.66
                                        c43.18-6.29,89.24-10.35,124.67-37.25c0.32-0.24,0.53-0.17,0.62,0.22c4.16,17.97,11.34,35.34,24.27,48.86
                                        c0.29,0.31,0.4,0.25,0.31-0.17c-2.69-13.3-4.34-26.37-4.94-39.21c-1-21.41-0.71-43.25,0.86-65.51c0.2-2.82,0.88-7.41,2.04-13.76
                                        c1.46-8,5.26-15.51,11.39-22.54c15.09-17.31,30.76-32.92,33.64-56.14c0.02-0.19-0.06-0.31-0.25-0.34l-0.25-0.04
                                        C291.55,313.14,291.53,313.16,291.52,313.19z M178.75,219.22c0.48-10.81,0.41-24.42,11.28-29.75c6.98-3.42,17.86-1.79,25.02,1.41
                                        c2.51,1.12,2.76,0.74,0.75-1.13c-10.86-10.14-22.62-15.45-37.58-12.29c-6.6,1.4-11.45,4.56-15.78,9.53
                                        c-0.27,0.31-0.25,0.6,0.05,0.87c2.42,2.25,3.62,4.35,5.86,7.88c4.65,7.33,7.8,15.29,9.46,23.86c0.05,0.27,0.21,0.36,0.46,0.27
                                        C178.57,219.78,178.73,219.56,178.75,219.22z M199.03,229.8c10.55-4.05,18.56-11.23,26.51-19.24c0.51-0.51,0.43-0.65-0.26-0.41
                                        c-8.53,2.98-17.1,4.7-25.83,6.88c-11.63,2.91-22.66,9.53-34.96,9.07c-0.21-0.01-0.53-0.1-0.96-0.25c-0.35-0.13-0.7-0.17-1.05-0.12
                                        c-0.42,0.05-0.45,0.19-0.09,0.42C174.06,233.48,186.28,234.69,199.03,229.8z M119.61,504.92c24.63,1.28,48.89,4.21,72.79,8.78
                                        c0.57,0.11,0.59,0.05,0.05-0.18c-24.21-10.28-50-12.35-75.9-9.22c-0.9,0.11-0.9,0.22,0,0.35
                                        C117.43,504.77,118.45,504.86,119.61,504.92z" />
                            <path d="M458.75,163.23c-2.45-1.42-5.18-2.28-7.78-3.29c-0.58-0.23-1.04-0.7-1.25-1.29c-5.93-16.81-15.56-32.4-26.69-46.22
                                        c-0.06-0.07-0.06-0.14,0.01-0.2h0.01c0.07-0.06,0.14-0.06,0.2,0.01c13.72,14.9,27.44,31.87,36.41,50.14
                                        C460.29,163.67,459.99,163.95,458.75,163.23z" />
                            <path d="M190.03,189.47c-10.87,5.33-10.8,18.94-11.28,29.75c-0.02,0.34-0.18,0.56-0.48,0.65c-0.25,0.09-0.41,0-0.46-0.27
                                        c-1.66-8.57-4.81-16.53-9.46-23.86c-2.24-3.53-3.44-5.63-5.86-7.88c-0.3-0.27-0.32-0.56-0.05-0.87c4.33-4.97,9.18-8.13,15.78-9.53
                                        c14.96-3.16,26.72,2.15,37.58,12.29c2.01,1.87,1.76,2.25-0.75,1.13C207.89,187.68,197.01,186.05,190.03,189.47z" />
                            <path d="M528.78,238.63c-1.41-0.3-1.55-0.01-0.4,0.87c17.89,13.77,44.57,15.62,64.14,4.46c15.7-8.94,27.99-26.27,28.49-44.86
                                        c0.01-0.01,0.01-0.01,0.02-0.01c0.11,0.01,0.2,0.01,0.26,0c0.06,0,0.09,0.03,0.1,0.08c3.97,23.08-3.29,45.68-20.24,61.4
                                        c-35.13,32.62-85.54,17.39-111.11-18.01c-0.17-0.24-0.07-0.59,0.21-0.68c16.73-5.68,32.48-13.38,47.27-23.1
                                        c1.97-1.3,3.86-3.12,6.57-3.67c2.71-0.55,4.2-0.87,4.47-0.97c13.88-5.07,28.05-18.45,29.82-34.05c0.2-1.76,0.47-1.77,0.8-0.03
                                        c0.81,4.26,1.14,8.98,1,14.15c-0.58,20.91-16.02,37.21-35.68,42.61C538.68,238.42,534.02,239.76,528.78,238.63z" />
                            <path d="M199.03,229.8c-12.75,4.89-24.97,3.68-36.64-3.65c-0.36-0.23-0.33-0.37,0.09-0.42c0.35-0.05,0.7-0.01,1.05,0.12
                                        c0.43,0.15,0.75,0.24,0.96,0.25c12.3,0.46,23.33-6.16,34.96-9.07c8.73-2.18,17.3-3.9,25.83-6.88c0.69-0.24,0.77-0.1,0.26,0.41
                                        C217.59,218.57,209.58,225.75,199.03,229.8z" />
                            <path d="M572.05,359.81c-37.57,13.65-78.58-0.74-105.6-28.31c-18.07-18.44-31.82-39.7-41.26-63.78c-1.28-3.26-2.37-6.6-3.26-10.02
                                        c-0.08-0.3,0.18-0.57,0.48-0.51c0.97,0.21,1.99,0.28,3.08,0.21c7.33-0.46,14.64-1.24,21.91-2.34c0.34-0.05,0.59,0.08,0.76,0.39
                                        c16.9,31.21,46.81,61.78,82.8,69.35c44.4,9.34,85.75-16.31,103.07-57c3.28-7.69,3.94-13.11,5.03-20.23c0.29-1.9,0.47-1.89,0.56,0.03
                                        c0.57,12,0.03,24.92-2.64,36.33C629.15,317.28,604.74,347.92,572.05,359.81z" />
                            <path d="M511.14,300.6c-20.93-10.74-38.21-28.71-51.38-48.1c-0.27-0.41-0.18-0.7,0.27-0.89c0.77-0.32,2.03-0.07,2.94-0.33
                                        c4.03-1.17,7.95-2.43,11.76-3.76c0.48-0.16,1,0.01,1.28,0.43c22.76,34.1,67.91,59.46,109.56,43.13c2.65-1.05,5.12-2.42,7.39-4.11
                                        c0.07-0.05,0.14-0.05,0.21,0.02V287c0.06,0.07,0.06,0.13,0,0.2c-3.36,3.55-6.96,6.85-10.8,9.9
                                        C561.81,313.39,533.7,312.17,511.14,300.6z" />
                            <path class="st0" d="M416.18,363.55c0.49,52.13,26.58,102.52,63.21,138.53c7.69,7.55,15.31,15.18,22.87,22.87
                                        c14.29,14.53,28.89,33.21,36.07,52.45c0.02,0.05,0,0.09-0.05,0.11l-0.24,0.1c-0.15,0.07-0.26,0.02-0.33-0.13
                                        c-2.13-4.77-4.73-8.9-7.82-12.41c-23.7-26.97-56.11-43.44-80.61-69.62c-34.21-36.54-44.45-83.27-33.64-131.96
                                        C415.99,361.95,416.17,361.97,416.18,363.55z" />
                            <path d="M119.61,504.92c-1.16-0.06-2.18-0.15-3.06-0.27c-0.9-0.13-0.9-0.24,0-0.35c25.9-3.13,51.69-1.06,75.9,9.22
	                                    c0.54,0.23,0.52,0.29-0.05,0.18C168.5,509.13,144.24,506.2,119.61,504.92z" />
                            <path class="st0" d="M391.05,671.38c15.98-9.6,32.04-17.57,48.17-26.19c3.78-2.02,8.54-4.04,12.6-6.31
                                        c0.59-0.33,1.13-0.25,1.61,0.23l3.49,3.49c0.5,0.51,0.43,0.92-0.2,1.25c-22.92,11.82-40.38,21.64-52.38,29.46
                                        c-7.18,4.67-14.4,9.23-21.66,13.66c-0.36,0.22-0.81,0.19-1.14-0.06l-23.6-17.99c-0.27-0.21-0.26-0.61,0.02-0.79
                                        c24.58-16.16,50.69-30.54,76.77-44.01c0.72-0.37,1.59-0.27,2.19,0.26l8.58,7.46c0.43,0.37,0.37,1.05-0.11,1.35
                                        c-17.3,10.55-32.83,19.88-49.91,33.94c-1.4,1.16-2.85,2.87-4.52,4.11C390.03,671.93,390.06,671.98,391.05,671.38z" />
                            <path d="M252.83,668.81c38.32,16.32,71.35,40.48,99.41,71.22c0.18,0.2,0.17,0.39-0.03,0.57l-9.42,8.53
                                        c-0.28,0.25-0.72,0.23-0.97-0.05c-23.76-26.01-50.99-47.77-81.68-65.26c-25.79-14.7-52.55-27.57-79.91-39.06
                                        c-0.13-0.05-0.17-0.15-0.12-0.28v-0.01c0.05-0.13,0.14-0.18,0.28-0.14C207.45,652.37,228.93,658.63,252.83,668.81z" />
                        </svg>
                    </label>
                </td>
                <td></td>
                <td></td>
                <td>
                    <label for="type2" class="room">
                        <input type="radio" name="type" class="cat_fill type" id="type2" value="2" />
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 116.36 122.88">
                            <path d="M85.62,74.85a6.32,6.32,0,0,1,1.11.38L84.87,57.44h0a1.14,1.14,0,0,1,1-1.24,1.12,1.12,0,0,1,1.23,1L89.18,77A7.06,7.06,0,0,1,91,81.72V93.24H109l4.4-51.79H80.16l1.75,19.4a23.15,23.15,0,0,1,3.14,5A1.28,1.28,0,0,1,85.61,67v7.87Zm-58.44,13c18.26,5.33,35,5,50.46,0v21c-15,5.92-31.52,6.78-50.46,0v-21ZM71.3,55.05A55.46,55.46,0,0,0,52,47.49c-.8,8.92-4.32,14.39-9.75,17.55C37.33,67.87,31,68.77,23.72,68.6a14.21,14.21,0,0,0,1.36.71c5.47,2.52,15.82,3.94,26.36,4.08s21.2-1,27.28-3.52a9.06,9.06,0,0,0,4.06-2.77c-2-4.72-6.38-8.82-11.48-12ZM83.05,76.89c.19-.78,0-5.43,0-6.49a16.32,16.32,0,0,1-3.34,1.84c-6.4,2.68-17.44,3.86-28.3,3.71S29.8,74.3,24,71.64a14.18,14.18,0,0,1-2.24-1.26v6.8c4.22,3.87,17,5.93,30,6s26.27-1.89,31.3-6v-.24Zm-63.85.42a4.34,4.34,0,0,0-2,1.13,4.2,4.2,0,0,0-1.24,3v31.52l.56.38c8.77,5.72,25.34,7.53,40.51,6.89,14.89-.63,28.27-3.53,31.38-7.34V81.72a4.51,4.51,0,0,0-1.33-3.19,4.59,4.59,0,0,0-1.47-1v.16a1.28,1.28,0,0,1-.49,1c-5.24,4.8-19.46,7.07-33.38,7S23.89,83.2,19.56,78.59v0a1.28,1.28,0,0,1-.34-.87h0v-.39Zm22.5-15a60,60,0,0,0-10.87,1.59,37.15,37.15,0,0,0-6.31,2.12c6.5.09,12.15-.75,16.4-3.23q.4-.23.78-.48ZM91,96.47v5c5.81.4,15.33.29,16.57-.87A4,4,0,0,0,108.62,98v0l.14-1.53H91Zm-.4,17.77,0,0c-3.36,4.46-17.68,7.83-33.41,8.49s-32.76-1.27-42-7.3c-.42-.28-.82-.56-1.22-.85a1.34,1.34,0,0,1-.3-.33H1.47A1.48,1.48,0,0,1,0,112.8V69.74a1.47,1.47,0,0,1,1.47-1.47H3.7V43.54a1.4,1.4,0,0,1,1.4-1.39H7.76V17.21c5,.79,9.64,3.49,13.85,9.5V42.15h2.16a1.39,1.39,0,0,1,1.39,1.39V63a42.48,42.48,0,0,1,5.05-1.58,63.14,63.14,0,0,1,14.46-1.75h.08c2.72-3.09,4.41-7.52,4.76-13.74a1.27,1.27,0,0,1,1.34-1.21l.17,0a46.47,46.47,0,0,1,6.43,1.36V29.64a.53.53,0,0,1,0-.13l-9.21-22a.94.94,0,0,1,.29-1.2c10.73-7.89,18-9.06,28.35,0a.94.94,0,0,1,.19,1.18L68.77,29.88h0V50.64c1.32.69,2.62,1.44,3.88,2.23a42.08,42.08,0,0,1,6.75,5.25L77.86,41a1.11,1.11,0,0,1-.24-.69,1.19,1.19,0,0,1,.13-.53l-.53-5.9a1.13,1.13,0,0,1,1-1.23h37a1.13,1.13,0,0,1,1.13,1.13.88.88,0,0,1,0,.16l-.52,6.11a1.09,1.09,0,0,1,0,.26,1.12,1.12,0,0,1-.09.44l-4.88,57.41a.22.22,0,0,1,0,.08,6.22,6.22,0,0,1-1.77,4,4.94,4.94,0,0,1-2,1.11v8.92a1.93,1.93,0,0,1-1.94,1.94H90.57Zm-71.37-46V67a1.29,1.29,0,0,1,.56-1.06,16,16,0,0,1,2.62-1.66V44.92H6.48V68.27H19.2ZM59.33,46.69a60.65,60.65,0,0,1,7.56,3V46.21H59.33v.48Zm0-2.36h7.56V31.15H59.33V44.33ZM84,46.55a1.13,1.13,0,1,1,2.23-.36l.66,4.2a1.13,1.13,0,0,1-2.23.36L84,46.55Zm26.23-11.62V39.2h3.36l.36-4.27ZM108,39.2V34.92h-3.85V39.2Zm-6.1,0V34.92H98.07V39.2Zm-6.09,0V34.92H92V39.2Zm-6.1,0V34.92H85.88V39.2Zm-6.1,0V34.92H79.57L80,39.2Z" />
                        </svg>
                    </label>
                </td>
                <td></td>
                <td></td>
                <td>
                    <label for="type3" class="room">
                        <input type="radio" name="type" class="cat_fill type" id="type3" value="3" />
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 116.36 122.88">
                            <path d="M85.62,74.85a6.32,6.32,0,0,1,1.11.38L84.87,57.44h0a1.14,1.14,0,0,1,1-1.24,1.12,1.12,0,0,1,1.23,1L89.18,77A7.06,7.06,0,0,1,91,81.72V93.24H109l4.4-51.79H80.16l1.75,19.4a23.15,23.15,0,0,1,3.14,5A1.28,1.28,0,0,1,85.61,67v7.87Zm-58.44,13c18.26,5.33,35,5,50.46,0v21c-15,5.92-31.52,6.78-50.46,0v-21ZM71.3,55.05A55.46,55.46,0,0,0,52,47.49c-.8,8.92-4.32,14.39-9.75,17.55C37.33,67.87,31,68.77,23.72,68.6a14.21,14.21,0,0,0,1.36.71c5.47,2.52,15.82,3.94,26.36,4.08s21.2-1,27.28-3.52a9.06,9.06,0,0,0,4.06-2.77c-2-4.72-6.38-8.82-11.48-12ZM83.05,76.89c.19-.78,0-5.43,0-6.49a16.32,16.32,0,0,1-3.34,1.84c-6.4,2.68-17.44,3.86-28.3,3.71S29.8,74.3,24,71.64a14.18,14.18,0,0,1-2.24-1.26v6.8c4.22,3.87,17,5.93,30,6s26.27-1.89,31.3-6v-.24Zm-63.85.42a4.34,4.34,0,0,0-2,1.13,4.2,4.2,0,0,0-1.24,3v31.52l.56.38c8.77,5.72,25.34,7.53,40.51,6.89,14.89-.63,28.27-3.53,31.38-7.34V81.72a4.51,4.51,0,0,0-1.33-3.19,4.59,4.59,0,0,0-1.47-1v.16a1.28,1.28,0,0,1-.49,1c-5.24,4.8-19.46,7.07-33.38,7S23.89,83.2,19.56,78.59v0a1.28,1.28,0,0,1-.34-.87h0v-.39Zm22.5-15a60,60,0,0,0-10.87,1.59,37.15,37.15,0,0,0-6.31,2.12c6.5.09,12.15-.75,16.4-3.23q.4-.23.78-.48ZM91,96.47v5c5.81.4,15.33.29,16.57-.87A4,4,0,0,0,108.62,98v0l.14-1.53H91Zm-.4,17.77,0,0c-3.36,4.46-17.68,7.83-33.41,8.49s-32.76-1.27-42-7.3c-.42-.28-.82-.56-1.22-.85a1.34,1.34,0,0,1-.3-.33H1.47A1.48,1.48,0,0,1,0,112.8V69.74a1.47,1.47,0,0,1,1.47-1.47H3.7V43.54a1.4,1.4,0,0,1,1.4-1.39H7.76V17.21c5,.79,9.64,3.49,13.85,9.5V42.15h2.16a1.39,1.39,0,0,1,1.39,1.39V63a42.48,42.48,0,0,1,5.05-1.58,63.14,63.14,0,0,1,14.46-1.75h.08c2.72-3.09,4.41-7.52,4.76-13.74a1.27,1.27,0,0,1,1.34-1.21l.17,0a46.47,46.47,0,0,1,6.43,1.36V29.64a.53.53,0,0,1,0-.13l-9.21-22a.94.94,0,0,1,.29-1.2c10.73-7.89,18-9.06,28.35,0a.94.94,0,0,1,.19,1.18L68.77,29.88h0V50.64c1.32.69,2.62,1.44,3.88,2.23a42.08,42.08,0,0,1,6.75,5.25L77.86,41a1.11,1.11,0,0,1-.24-.69,1.19,1.19,0,0,1,.13-.53l-.53-5.9a1.13,1.13,0,0,1,1-1.23h37a1.13,1.13,0,0,1,1.13,1.13.88.88,0,0,1,0,.16l-.52,6.11a1.09,1.09,0,0,1,0,.26,1.12,1.12,0,0,1-.09.44l-4.88,57.41a.22.22,0,0,1,0,.08,6.22,6.22,0,0,1-1.77,4,4.94,4.94,0,0,1-2,1.11v8.92a1.93,1.93,0,0,1-1.94,1.94H90.57Zm-71.37-46V67a1.29,1.29,0,0,1,.56-1.06,16,16,0,0,1,2.62-1.66V44.92H6.48V68.27H19.2ZM59.33,46.69a60.65,60.65,0,0,1,7.56,3V46.21H59.33v.48Zm0-2.36h7.56V31.15H59.33V44.33ZM84,46.55a1.13,1.13,0,1,1,2.23-.36l.66,4.2a1.13,1.13,0,0,1-2.23.36L84,46.55Zm26.23-11.62V39.2h3.36l.36-4.27ZM108,39.2V34.92h-3.85V39.2Zm-6.1,0V34.92H98.07V39.2Zm-6.09,0V34.92H92V39.2Zm-6.1,0V34.92H85.88V39.2Zm-6.1,0V34.92H79.57L80,39.2Z" />
                        </svg>
                    </label>
                </td>
            </tr>
        </table>
    </div>

    <div class="container-fluid mb-3">
        <div class="box">
            <div class="box-body d-block">
                <div class="row" id="cat-box"></div>
            </div>
        </div>
    </div>


    <!-- Bootstrap 5.3.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <!-- Jquery 3.7.1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        function btn_dll(id) {
            var info = 'id=' + id;
            if (confirm("Sure you want to delete this Collection? There is NO undo!")) {
                $.ajax({
                    type: "GET",
                    url: "sales_list_dll.php",
                    data: info,
                    success: function(res) {
                        console.log(res);
                    }
                });
                $(".record_" + id).animate({
                        backgroundColor: "#fbc7c7"
                    }, "fast")
                    .animate({
                        opacity: "hide"
                    }, "slow");
            }
            return false;
        }
        $('.closer').click(function() {
            $('#down-up').css("transform", "translateY(101%)");
        });

        function check() {
            let val = $('#price').val();
            if (val > 0) {
                $('#odr_btn').removeAttr('disabled');
            } else {
                $('#odr_btn').attr('disabled', '');
            }
        }

        function sales_add_list() {
            let id = document.getElementById('p_id').value;
            let price = document.getElementById('price').value;
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("cat-box").innerHTML = xmlhttp.responseText;
                    sales_get();
                }
            }

            xmlhttp.open("GET", "appointment_sales_add.php?id=" + id + "&invo=<?php echo $invo ?>&price=" + price, true);
            xmlhttp.send();

            containerDown();
            $('#price').val('');
        }

        function open_model(id, p_name, p_code) {
            $('#p_id').val(id);
            $('#top').text(p_name);
            $('#sub-top').text(p_code);
            $('#down-up').css('transform', "translateY(0)");
        }

        function containerDown() {
            $('#down-up').css("transition", "transform 0.75s ease 0.2s");
            $('#down-up').css("transform", "translateY(101%)");
        }

        function sales_get() {
            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("sales_list").innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "appointment_item_get.php?unit=2&invo=<?php echo $invo; ?>", true);
            xmlhttp.send();
        }

        $(document).ready(function() {

            $('input[type="number"]').focus(function() {
                $(this).select();
            });

            var type = 1;

            var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("cat-box").innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "appointment_item_get.php?unit=1&invo=<?php echo $invo; ?>&type=" + type, true);
            xmlhttp.send();

            sales_get();

            $(".cat_fill").click(function() {
                var type = $(this).attr("value");

                if (type > 0) {
                    var xmlhttp;
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("cat-box").innerHTML = xmlhttp.responseText;
                        }
                    }

                    xmlhttp.open("GET", "appointment_item_get.php?unit=1&invo=<?php echo $invo; ?>&type=" + type, true);
                    xmlhttp.send();
                } else {
                    var xmlhttp;
                    if (window.XMLHttpRequest) {
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function() {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("cat-box").innerHTML = xmlhttp.responseText;
                        }
                    }

                    xmlhttp.open("GET", "appointment_item_get.php?unit=3&invo=<?php echo $invo; ?>", true);
                    xmlhttp.send();
                }
            });
        });
    </script>
</body>

</html>