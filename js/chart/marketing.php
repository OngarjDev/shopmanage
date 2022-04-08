
const ctxprofit = document.getElementById('profit');
const charprofit = new Chart(ctxprofit, {
    data: {
        datasets: [{
            type: 'line',
            label: 'จำนวนเงินที่ขายได้',
                <?php
                    $year = date('Y');
                    require_once('../php_action/dbconnect.php');
                    $money_sum = [];
                    $total = [];
                    for ($i = 1; $i <= 12; $i++) {
                        $sql = "SELECT * FROM history WHERE datetime_history BETWEEN '$year-$i-01' AND '$year-$i-31'";
                        $result = $con->query($sql);
                        $money = [];
                        while ($row = $result->fetch_assoc()) {
                            array_push($money, $row['money_history']);
                        }
                        $money_sum = array_sum($money);
                        array_push($total, $money_sum);
                    }
                ?>
            data: [<?php for ($i = 0; $i <= 12; $i++) { echo $total[$i] . ',';}?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        },
        {
            type: 'bar',
            label: 'จำนวนรายการต่อเดือน',
            <?php
                $year = date('Y');
                require_once('../php_action/dbconnect.php');
                $mouth = [];
                for ($i = 1; $i <= 12; $i++) {
                    $sql = "SELECT * FROM history WHERE datetime_history BETWEEN '$year-$i-01' AND '$year-$i-31'";
                    $result = $con->query($sql);
                    $row_num = $result->num_rows;
                    array_push($mouth,$row_num);
                }
            ?>
                data: [<?php foreach($mouth as $value){ echo $value.',';}?>],
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
            }],
        labels: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
    },    
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const ctxtop10 = document.getElementById('top10');
const Charttop10 = new Chart(ctxtop10, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange', 'Green'],
        datasets: [{
            label: 'สินค้าที่ขายได้มากที่สุด10อันดับแรก',
            data: [12, 19, 3, 5, 2, 3, 9],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
    indexAxis: 'y',
        scales: {
            y: {
                ticks: {
                    crossAlign: 'far',
                }
            }
        }
    }
});



const group = document.getElementById('group');
const Chartgroup = new Chart(group, {
    type: 'doughnut',
    data: {
        <?php
            
        ?>
        labels: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
        datasets: [{
            label: 'ยอดการทำรายการในแต่ละเดือน',
            data: [
                <?php

                ?>
                ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const ctxtransfer = document.getElementById('transfer');
const Charttransfer = new Chart(ctxtransfer, {
    type: 'bar',
    data: {

        labels: ['ช่องทางธนาคาร', 'ช่องทางรับเงินสด'],
        datasets: [{
            label: 'ช่องทางชำระเงิน',
            <?php
                    require_once('../php_action/dbconnect.php');
                    $sql_bank = "SELECT * FROM history WHERE transfer_history = 'bank'";
                    $result_bank = $con->query($sql_bank);
                    $row_numbank = $result_bank->num_rows;
                    $sql_cash = "SELECT * FROM history WHERE transfer_history = 'cash'";
                    $result_cash = $con->query($sql_cash);
                    $row_numcash= $result_cash->num_rows;
            ?>
            data: ['<?php echo $row_numbank?>', '<?php echo $row_numcash?>'],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
    }
});

const ctxstaff = document.getElementById('staffs');
const Chartstaff = new Chart(ctxstaff, {
    type: 'bar',
    data: {
        <?php
        $sql = "SELECT * FROM staff INNER JOIN history ON staff.staff_id = history.staff_id";
        $result = $con->query($sql);
        // while($row = $result->num)    
        ?>
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
        datasets: [{
            label: 'ยอดการทำรายการ รวมทั้งหมด',
            data: [12, 19, 3, 5, 2],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});