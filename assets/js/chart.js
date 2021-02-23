$(document).ready(function () {
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"SegoeUI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var PTI = document.getElementById("PTI").value;
    var SI = document.getElementById("SI").value;
    var MI = document.getElementById("MI").value;
    var Ilkom = document.getElementById("Ilkom").value;
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["PTI", "SI", "MI", "Ilkom"],
            datasets: [{
                data: [PTI, SI, MI, Ilkom],
                backgroundColor: ['#7c4fe0', '#28a745', '#17a2b8','#ffc107'],
                hoverBackgroundColor: ['#7c4fe0', '#28a745', '#17a2b8','#ffc107'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
});
$(document).ready(function () {
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"SegoeUI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("myAngkatanChart");
    let kr_2 = document.getElementById("thn_2018").value;
    let kr_1 = document.getElementById("thn_2019").value;
    let sk = document.getElementById("thn_2020").value;
    let tahun = new Date().getFullYear();
    let kurang_1 = tahun - 1;
    let kurang_2 = tahun - 2;
    var myAngkatanChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [kurang_2, kurang_1, tahun],
            datasets: [{
                data: [kr_2, kr_1, sk],
                backgroundColor: ['#7c4fe0', '#28a745', '#17a2b8'],
                hoverBackgroundColor: ['#7c4fe0', '#28a745', '#17a2b8'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });
});