$(document).ready(function() {

    const sendProdi = () => {
        const data = new FormData()
        let value = document.getElementById('id_kegiatan').value;
        data.append("id_kegiatan", value);
        if (value != "") {
            fetch(baseURL + "etika/countProdi", {
                method: "POST",
                body: data,
            })
            .then(response => response.text())
            .then(data => {
                if (data != "") {
                    document.getElementById("form-diagram").innerHTML = data;
                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"SegoeUI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#858796';
                    let SI = document.getElementById('SI_Diagram').value;
                    let MI = document.getElementById('MI_Diagram').value;
                    let PTI = document.getElementById('PTI_Diagram').value;
                    let Ilkom = document.getElementById('Ilkom_Diagram').value;
                    // Pie Chart Example
                    let ctx = document.getElementById("prodiChart").getContext('2d');
                    let prodi = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ["SI", "MI", "PTI", "Ilkom"],
                            datasets: [{
                                data: [SI,MI,PTI,Ilkom],
                                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f6c23e'],
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
                            scales: {
                                yAxes: [{
                                    display: true,
                                    ticks: {
                                        beginAtZero: true,
                                        stepSize: 5,
                                    }
                                }]
                            },
                        },
                    });
                } else {
                console.log(data);
                console.error("Can't Get Ajax Data");
                
                }
            });
        }
    }

    const sendSemester = () => {
        const data = new FormData()
        let value = document.getElementById('id_kegiatan').value;
        data.append("id_kegiatan", value);
        if (value != "") {
            fetch(baseURL + "etika/countSemester", {
                method: "POST",
                body: data,
            })
            .then(response => response.text())
            .then(data => {
                if (data != "") {
                    document.getElementById("form-diagram-semester").innerHTML = data;
                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"SegoeUI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#858796';
                    let A = document.getElementById('A_Diagram').value;
                    let B = document.getElementById('B_Diagram').value;
                    let C = document.getElementById('C_Diagram').value;
                    let D = document.getElementById('D_Diagram').value;
                    let ETC = document.getElementById('Etc_Diagram').value;
                    // Pie Chart Example
                    let d = new Date().getMonth() + 1;
                    if(d >= 1 && d <= 6){
                        var label = ["2", "4", "6", "8"];
                    }else {
                        var label = ["1", "3", "5", "7"];
                    }
                    let ctx = document.getElementById("semesterChart").getContext('2d');
                    let semester = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: label,
                            datasets: [{
                                data: [A,B,C,D,ETC],
                                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f6c23e'],
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
                            scales: {
                                    yAxes: [{
                                            display: true,
                                            ticks: {
                                                beginAtZero: true,
                                                stepSize: 5,
                                            }
                                    }]
                                },
                        },
                    });
                } else {
                console.log(data);
                console.error("Can't Get Ajax Data");
                
                }
            });
        }
        
    }

    const sendPemilih = () => {
        const data = new FormData()
        let value = document.getElementById('id_kegiatan').value;
        data.append("id_kegiatan", value);
        if (value != "") {
            fetch(baseURL + "etika/countPemilih", {
                method: "POST",
                body: data,
            })
            .then(response => response.text())
            .then(data => {
                if (data != "") {
                    document.getElementById("form-diagram-pemilih").innerHTML = data;
                    // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"SegoeUI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#858796';
                        let sudah = document.getElementById('sudah_Diagram').value;
                        let belum = document.getElementById('belum_Diagram').value;
                        // Pie Chart Example
                        let ctx = document.getElementById("pemilihChart").getContext('2d');
                        let pemilih = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Sudah Voting','Belum Voting'],
                                datasets: [{
                                    data: [sudah,belum],
                                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f6c23e'],
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
                                scales: {
                                        yAxes: [{
                                                display: true,
                                                ticks: {
                                                    beginAtZero: true,
                                                    stepSize: 5,
                                                }
                                        }]
                                    },
                            },
                        });
                        
                } else {
                console.log(data);
                console.error("Can't Get Ajax Data");
                
                }
            });
        }
    }

    const sendKandidat = () => {
            const data = new FormData()
            let value = document.getElementById('id_kegiatan').value;
            data.append("id_kegiatan", value);
            if (value != "") {
                fetch(baseURL + "etika/countKandidat", {
                    method: "POST",
                    body: data,
                })
                .then(response => response.text())
                .then(data => {
                    if (data != "") {
                        document.getElementById("form-diagram-kandidat").innerHTML = data;
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"SegoeUI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#858796';
                        var no = 1;
                        var datas = [];
                        var count = document.getElementById('count').value;
                        count = parseInt(count);
                        undi = [];
                        for (var i = 0; i < count; i++){
                            undi.push(no++)
                        }
                        for (var i= 0 ; i < count; i++){
                            datas.push(document.getElementById('Diagram'+i).value);
                        }
                        let ctx = document.getElementById("kandidatChart").getContext('2d');
                        let kandidat = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: undi,
                                datasets: [{
                                    data: datas,
                                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
                                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#f6c23e'],
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
                                scales: {
                                        yAxes: [{
                                                display: true,
                                                ticks: {
                                                    beginAtZero: true,
                                                    stepSize: 5,
                                                }
                                        }]
                                    },
                            },
                        });
                    
                    } else {
                        console.log(data);
                        console.error("Can't Get Ajax Data");
                        

                    }
                });
            }
    }


    setInterval(() => {
        sendProdi();
        sendSemester();
        sendPemilih();
        sendKandidat();
    }, 5000);
// loadDiagram()
});
