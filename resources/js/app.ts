import { themeChange } from 'theme-change'
window.addEventListener("livewire:navigated", () => {

themeChange();
})
themeChange();

import './bootstrap';
import "flyonui/flyonui";
import "flyonui/dist/input-number"
declare global {
    interface Window {
        ApexCharts: typeof ApexCharts;
    }
}
window.ApexCharts = ApexCharts;



import ApexCharts from 'apexcharts';
import {buildChart, buildTooltip} from "flyonui/dist/helper-apexcharts";
import 'lodash';
import 'apexcharts/dist/apexcharts.js';
// import 'apexcharts/dist/apexcharts.css';


window.addEventListener("livewire:navigated", () => {
    ;
    (function () {
        buildChart('#apex-doughnut-chart', mode => ({
          chart: {
            height: 300,
            type: 'donut'
          },
          plotOptions: {
            pie: {
              donut: {
                size: '70%',
                labels: {
                  show: true,
                  name: {
                    fontSize: '2rem'
                  },
                  value: {
                    fontSize: '1.5rem',
                    color: 'var(--color-base-content)',
                    formatter: function (val) {
                      return parseInt(val, 10) + '%'
                    }
                  },
                  total: {
                    show: true,
                    fontSize: '1rem',
                    label: 'Operational',
                    color: 'var(--color-primary)',
                    formatter: function (w) {
                      return '42%'
                    }
                  }
                }
              }
            }
          },
          series: [42, 7, 25, 25],
          labels: ['Operational', 'Networking', 'Hiring', 'R&D'],
          legend: {
            show: true,
            position: 'bottom',
            markers: { offsetX: -3 },
            labels: {
              useSeriesColors: true
            }
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            show: false,
            curve: 'straight'
          },
          colors: ['var(--color-primary)', 'var(--color-success)', 'var(--color-error)', 'var(--color-warning)'],
          states: {
            hover: {
              filter: {
                type: 'none'
              }
            }
          },
          tooltip: {
            enabled: true
          }
        }))
      })()
})


document.addEventListener('livewire:navigated', () => {
  ;(function () {
    buildChart('#apex-curved-area-charts', mode => ({
      chart: {
        height: 400,
        type: 'area',
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        }
      },
      series: [
        {
          name: 'Revenue',
          data: [18000, 32000, 50000, 45000, 60000, 85000, 78000, 92000, 86000, 89000, 95000, 102000]
        },
        {
          name: 'Expenses',
          data: [10000, 20000, 30000, 38000, 42000, 55000, 49000, 70000, 66000, 72000, 75000, 78000]
        }
      ],
      legend: {
        show: true,
        position: 'top',
        horizontalAlign: 'right',
        labels: {
          useSeriesColors: true
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 2
      },
      grid: {
        strokeDashArray: 2,
        borderColor: 'color-mix(in oklab, var(--color-base-content) 40%, transparent)'
      },
      colors: ['var(--color-warning)', 'var(--color-accent)'],
      fill: {
        type: 'gradient',
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.7,
          gradientToColors: ['var(--color-base-100)'],
          opacityTo: 0.3,
          stops: [0, 90, 100]
        }
      },
      xaxis: {
        type: 'category',
        tickPlacement: 'on',
        categories: [
          '1 March 2024',
          '1 April 2024',
          '1 May 2024',
          '1 June 2024',
          '1 July 2024',
          '1 August 2024',
          '1 September 2024',
          '1 October 2024',
          '1 November 2024',
          '1 December 2024',
          '1 January 2025',
          '1 February 2025'
        ],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        tooltip: {
          enabled: false
        },
        labels: {
          style: {
            colors: 'var(--color-base-content)',
            fontSize: '12px',
            fontWeight: 400
          },
          formatter: title => {
            let t = title

            if (t) {
              const newT = t.split(' ')
              t = `${newT[0]} ${newT[1].slice(0, 3)}`
            }

            return t
          }
        }
      },
      yaxis: {
        labels: {
          align: 'left',
          minWidth: 0,
          maxWidth: 140,
          style: {
            colors: 'var(--color-base-content)',
            fontSize: '12px',
            fontWeight: 400
          },
          formatter: value => (value >= 1000 ? `${value / 1000}k` : value)
        }
      },
      tooltip: {
        x: {
          format: 'MMMM yyyy'
        },
        y: {
          formatter: value => `$${value >= 1000 ? `${value / 1000}k` : value}`
        },
        custom: function (props) {
          const { categories } = props.ctx.opts.xaxis
          const { dataPointIndex } = props
          const title = categories[dataPointIndex].split(' ')
          const newTitle = `${title[0]} ${title[1]}`

          return buildTooltip(props, {
            title: newTitle,
            mode,
            hasTextLabel: true,
            wrapperExtClasses: 'min-w-28',
            labelDivider: ':',
            labelExtClasses: 'ms-2'
          })
        }
      },
      responsive: [
        {
          breakpoint: 568,
          options: {
            chart: {
              height: 300
            },
            labels: {
              style: {
                fontSize: '10px',
                colors: 'var(--color-base-content)'
              },
              offsetX: -2,
              formatter: title => title.slice(0, 3)
            },
            yaxis: {
              labels: {
                align: 'left',
                minWidth: 0,
                maxWidth: 140,
                style: {
                  fontSize: '10px',
                  colors: 'var(--color-base-content)'
                },
                formatter: value => (value >= 1000 ? `${value / 1000}k` : value)
              }
            }
          }
        }
      ]
    }))
  })()
})




window.addEventListener("livewire:navigated", () => {
  ;(function () {
    buildChart('#apex-column-bar-chart', mode => ({
      chart: {
        type: 'bar',
        height: 400,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        }
      },
      series: [
        {
          name: 'Investment',
          data: [25000, 39000, 65000, 45000, 79000, 80000, 69000, 63000, 60000, 66000, 90000, 78000]
        }
      ],
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '30px'
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      colors: ['var(--color-primary)', 'var(--color-base-100)'],
      xaxis: {
        categories: [
          'Cook',
          'Erin',
          'Jack',
          'Will',
          'Gayle',
          'Megan',
          'John',
          'Luke',
          'Ellis',
          'Mason',
          'Elvis',
          'Liam'
        ],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: 'var(--color-base-content)',
            fontSize: '12px',
            fontWeight: 400
          }
        }
      },
      yaxis: {
        labels: {
          align: 'left',
          minWidth: 0,
          maxWidth: 140,
          style: {
            colors: 'var(--color-base-content)',
            fontSize: '12px',
            fontWeight: 400
          },
          formatter: value => (value >= 1000 ? `${value / 1000}k` : value)
        }
      },
      states: {
        hover: {
          filter: {
            type: 'darken',
            value: 0.9
          }
        }
      },
      tooltip: {
        y: {
          formatter: value => `$${value >= 1000 ? `${value / 1000}k` : value}`
        },
        custom: function (props) {
          const { categories } = props.ctx.opts.xaxis
          const { dataPointIndex } = props
          const title = categories[dataPointIndex]
          const newTitle = `${title}`

          return buildTooltip(props, {
            title: newTitle,
            mode,
            hasTextLabel: true,
            wrapperExtClasses: 'min-w-28',
            labelDivider: ':',
            labelExtClasses: 'ms-2'
          })
        }
      },
      responsive: [
        {
          breakpoint: 568,
          options: {
            chart: {
              height: 300
            },
            plotOptions: {
              bar: {
                columnWidth: '10px'
              }
            },
            stroke: {
              width: 8
            },
            labels: {
              style: {
                fontSize: '10px',
                colors: 'var(--color-base-content)'
              },
              formatter: title => title.slice(0, 3)
            },
            yaxis: {
              labels: {
                align: 'left',
                minWidth: 0,
                maxWidth: 140,
                style: {
                  fontSize: '10px',
                  colors: 'var(--color-base-content)'
                },
                formatter: value => (value >= 1000 ? `${value / 1000}k` : value)
              }
            }
          }
        }
      ]
    }))
  })()
})
