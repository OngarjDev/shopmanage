
const ctxprofit = document.getElementById('profit'); 
const charprofit = new Chart(ctxprofit, {
    data: {
        datasets: [{
            type: 'line',
            label: 'ยอดรายได้รวม',//กราฟรายได้ต่อเดือน
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
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(180, 236, 250)',
                'rgb(118, 65, 242)',
                'rgb(196, 48, 219)',
                'rgb(48, 92, 219)',
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
            type: 'bar', //กราฟจำนวนรายการต่อเดือน
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
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(180, 236, 250)',
                    'rgb(118, 65, 242)',
                    'rgb(196, 48, 219)',
                    'rgb(48, 92, 219)',
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

const ctxtransfer = document.getElementById('transfer'); ///กราฟช่องทางการชำระเงิน
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
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(180, 236, 250)',
                'rgb(118, 65, 242)',
                'rgb(196, 48, 219)',
                'rgb(48, 92, 219)',
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

const ctxstaff = document.getElementById('staffs'); ///กราฟ พนักงานทั้งหมด
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
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(180, 236, 250)',
                'rgb(118, 65, 242)',
                'rgb(196, 48, 219)',
                'rgb(48, 92, 219)',
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


<?php ///กราฟ สินค่าทั้งหมด
require_once('../php_action/dbconnect.php');
$sql = "SELECT name_item,number_item FROM item";
$result = $con->query($sql);
$name_item = array();
$number_item = array();
while ($row = $result->fetch_assoc()) {
    array_push($name_item, $row['name_item']);
    array_push($number_item, $row['number_item']);
}
$count = array_sum($number_item);
?>
const datapoints = [<?php foreach($number_item as $number){echo $number.',';}?>];
const data = {
    label: 'จำนวนสินค้าที่มีอยู่',
    datasets: [{
        data: datapoints,
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)',
            'rgb(180, 236, 250)',
            'rgb(118, 65, 242)',
            'rgb(196, 48, 219)',
            'rgb(48, 92, 219)',
        ],
        borderWidth: 1,
        cutout: '78%',
        borderRadius: 5,
    }],
    labels: [<?php foreach($name_item as $name){echo "'".$name."'".',';}?>],
}
const counter = {
    id: 'counter',
    beforeDraw(chart, args, options) {
        const {
            ctx,
            chartArea: {
                top,
                right,
                bottom,
                left,
                height,
                width
            }
        } = chart;
        ctx.save()
        ctx.font = options.fontSize + ' ' + options.fontFamily;
        ctx.textAlign = 'center';
        ctx.fillStyle = options.fontColor;
        ctx.fillText('สินค้าทั้งหมด', width / 2, height / 2);
        ctx.fillText('<?= $count ?>'+'ชิ้น', width / 2, height / 1.55);
    }
};
const config = {
    type: 'doughnut',
    data,
    options: {
        plugins: {
            legend:{
                display: false //ไม่แสดง Label ข้างบนให้คลิก
            },
            // tooltip: {
            //     enabled: false // ไม่แสดงรายละเอียด ชื่อสินค้า และจำนวนเมื่อวางเมาส์บนกราฟ
            // },
            counter: {
                fontColor: '#FF93A7',
                fontSize: '40px',
                fontFamily: 'sans-serif'
            }
        }
    },
    plugins: [counter],
    hoverOffset: 4
}
const Chartnumberitem = new Chart(document.getElementById('sumtoday'), config);