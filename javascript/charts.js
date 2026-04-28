export function investment_chart (array) {
    if (!Array.isArray(array)) return;
    if (Object.keys(array).length !== 4) return;

    return new Chart(document.getElementById("chart"), {
        type: "doughnut",
        data: {
            labels: ["Акции", "Облигации", "Валюта", "Металлы"],
            datasets: [
                {
                    data: [array[0], array[1], array[2], array[3]],
                    borderRadius: 10,
                    borderWidth: 1,
                    backgroundColor: [
                        "rgba(255, 99, 132,  0.5)",
                        "rgba(255, 159, 64,  0.5)",
                        "rgba(255, 205, 86,  0.5)",
                        "rgba(75, 192, 192,  0.5)",
                        "rgba(54, 162, 235,  0.5)",
                        "rgba(153, 102, 255, 0.5)",
                        "rgba(201, 203, 207, 0.5)",
                    ],
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } },
        },
    })
}

export function history_chart (array) {
    if (!Array.isArray(array)) return;
    if (Object.keys(array).length !== 5) return;

    return new Chart(document.getElementById("chart"), {
        type: "doughnut",
        data: {
            labels: ["Пополнение", "Покупка", "Переводы", "Снятие", "Инвестиции"],
            datasets: [
                {
                    data: [array[0], array[1], array[2], array[3], array[4]],
                    borderRadius: 10,
                    borderWidth: 1,
                    backgroundColor: [
                        "rgba(255, 99, 132,  0.5)",
                        "rgba(255, 159, 64,  0.5)",
                        "rgba(255, 205, 86,  0.5)",
                        "rgba(75, 192, 192,  0.5)",
                        "rgba(54, 162, 235,  0.5)",
                        "rgba(153, 102, 255, 0.5)",
                        "rgba(201, 203, 207, 0.5)",
                    ],
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } },
        },
    })
}

export function dashboard_chart (array) {
    if (!Array.isArray(array)) return;
    if (Object.keys(array).length !== 5) return;

    return new Chart(document.getElementById('chart'), {
        type: 'bar',
        data: {
            labels: ["Пополнение", "Покупка", "Переводы", "Снятие", "Инвестиции"],
            datasets: [{
                label: 'Траты за месяц',
                data: [array[0], array[1], array[2], array[3], array[4]],
                borderRadius: 15,
                backgroundColor: [
                    'rgba(255, 99, 132,  0.5)',
                    'rgba(255, 159, 64,  0.5)',
                    'rgba(255, 205, 86,  0.5)',
                    'rgba(75, 192, 192,  0.5)',
                    'rgba(54, 162, 235,  0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(201, 203, 207, 0.5)'
                ],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                  beginAtZero: true
                }
            }
        }
    })
}