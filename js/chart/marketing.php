
const ctxprofit = document.getElementById('profit');
const charprofit = new Chart(ctxprofit, {
    data: {
        datasets: [{
            type: 'line',
            label: 'ยอดรายได้รวม',
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
            require_once('../php_action/dbconnect.php');
            $sql = "SELECT * FROM staff";
            $result = $con->query($sql);
            $name_staff = array();
            $id_staff = array();
            while($row = $result->fetch_assoc()){
                array_push($name_staff, $row['fname_staff']);
                array_push($id_staff, $row['id_staff']);
            }
            $num_staff = count($id_staff); 

            $num_history = array();
            for ($i=0; $i < $num_staff; $i++) { 
                $sql = "SELECT * FROM history WHERE id_staff = '$id_staff[$i]'";
                $result = $con->query($sql);
                array_push($num_history, $result->num_rows);
            }
        ?>
        labels: [<?php foreach($name_staff as $value){ echo '"'.$value.'"'.',';}?>],
        datasets: [{
            label: 'ยอดการทำรายการ รวมทั้งหมด',
            data: [<?php foreach($num_history as $value){ echo $value.',';}?>],
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