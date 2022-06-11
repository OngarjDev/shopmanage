<<<<<<< HEAD
<?php
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
                display: false
            },
            // tooltip: {
            //     enabled: false
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
=======
<?php
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
                display: false
            },
            // tooltip: {
            //     enabled: false
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
>>>>>>> 2856649ca7bf589cd8c5976ab14e7a58e7915552
const Chartnumberitem = new Chart(document.getElementById('sumtoday'), config);