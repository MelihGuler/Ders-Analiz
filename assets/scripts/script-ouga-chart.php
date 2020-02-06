<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    window.onload = function () {
        <?php
        $ders_etkilesim=getTeacher(getDersEtkilesim($_SESSION['profession']));

        ?>
        var obj1={
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Öğretim Üyelerine Göre"
            },
            axisY: {
                title: "Ders Etkileşim Sayıları"
            },
            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                legendText: "Öğretim Üyeleri",
                dataPoints:[
                    <?php
                    foreach ($ders_etkilesim as $de)
                        echo '{ y: '.$de['etkilesim_sayisi'].', label: "'.$de['ad'].' '.$de['soyad'].'" },';
                    ?>
                ]
            }]
        };
        var obj2={
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Öğretim Üyelerine Göre %"
            },
            axisY: {
                title: "Ders Etkileşim Oranları %"
            },
            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                legendText: "Öğretim Üyeleri",
                dataPoints:[
                    <?php
                    foreach ($ders_etkilesim as $de) {
                        if($de['ogrenci_sayisi'])
                        echo '{ y: ' . ((($de['etkilesim_sayisi'] / 2) / $de['ogrenci_sayisi']) * 100) . ', label: "' . $de['ad'] . ' ' . $de['soyad'] . '" },';
                    }
                        ?>
                ]
            }]
        };

        var chart1 = new CanvasJS.Chart("dersEtkilesimSayisiGrafik", obj1);
        var chart2 = new CanvasJS.Chart("dersEtkilesimOraniGrafik", obj2);
        chart1.render();
        chart2.render();

    }
</script>