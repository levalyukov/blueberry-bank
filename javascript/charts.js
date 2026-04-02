export function initChart (filter) {
  let type;

  switch (filter) {
    case "all":
      type = 'doughnut';
      break;
    case "refill":
      type = 'line';
      break;
    case "offs":
      type = 'line';
      break;
    case "week":
      type = 'doughnut';
      break;
    case "month":
      type = 'doughnut';
      break;
  };

  return new Chart(document.getElementById('chart'), {
    type: type,
    data: {
      labels: ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь"],
      datasets: [{
        label: 'Траты за месяц',
        data: [432612.01, 1432612.01, 5432612.01, 732612.01, 3432612.01, 1432612.01],
        borderRadius: 10,
        borderWidth: 1,
        backgroundColor: [
          'rgba(255, 99, 132,  0.5)',
          'rgba(255, 159, 64,  0.5)',
          'rgba(255, 205, 86,  0.5)',
          'rgba(75, 192, 192,  0.5)',
          'rgba(54, 162, 235,  0.5)',
          'rgba(153, 102, 255, 0.5)',
          'rgba(201, 203, 207, 0.5)'],}]},
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {y: {beginAtZero: true}}
    }
  });
};

export function investmentChart () {
  return new Chart(document.getElementById('chart'), {
    type: 'doughnut',
    data: {
      labels: ["Акции", "Облигации", "Металлы", "Валюта"],
      datasets: [{
        data: [432612.01, 1432612.01, 532612.01, 732612.01],
        borderRadius: 10,
        borderWidth: 1,
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
      scales: {y: {beginAtZero: true}}
    }
  });
};