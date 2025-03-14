import './bootstrap';
import "flyonui/flyonui"

declare global {
  interface Window {
    ApexCharts: typeof ApexCharts;
  }
}



import  ApexCharts from 'apexcharts';
import { buildChart, buildTooltip } from "flyonui/dist/js/helper-apexcharts";
import 'lodash/lodash.js';
import 'apexcharts/dist/apexcharts.js';
import 'apexcharts/dist/apexcharts.css';


  window.addEventListener("livewire:navigated", () => {
    ;(function () {
      buildChart("#apex-doughnut-chart", mode => ({
        chart: {
          height: 300,
          type: "donut"
        },
        plotOptions: {
          pie: {
            donut: {
              size: "70%",
              labels: {
                show: true,
                name: {
                  fontSize: "2rem"
                },
                value: {
                  fontSize: "1.5rem",
                  color: "oklch(var(--bc) / 0.9)",
                  formatter: function (val) {
                    return parseInt(val, 10) + "$"
                  }
                },
                total: {
                  show: true,
                  fontSize: "1rem",
                  color: "oklch(var(--p))",
                  label: "Total",
                  formatter: function (w) {
                    return "2000$"
                  }
                }
              }
            }
          }
        },
        series: [1500, 233, 1000, 50],
        labels: ["Crypto", "Immobilien", "Cash", "Aktien"],
        legend: {
          show: true,
          position: "bottom",
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
          curve: "straight"
        },
        colors: ["oklch(var(--p))", "oklch(var(--su))", "oklch(var(--er))", "oklch(var(--n))"],
        states: {
          hover: {
            filter: {
              type: "none"
            }
          }
        },
        tooltip: {
          enabled: true
        }
      }))
    })()
  })


window.ApexCharts = ApexCharts;
document.addEventListener('livewire:navigated', () => { 
    ;(function () {
    // Apex Single Area Chart (Start)
    buildChart('#chart', mode => ({
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
          name: 'Units',
          data: [0, 100, 50, 125, 70, 150, 100, 170, 120, 175, 100, 200]
        }
      ],
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight',
        width: 2
      },
      grid: {
        strokeDashArray: 2,
        borderColor: 'oklch(var(--bc) / 0.4)'
      },
      colors: ['oklch(var(--p))'], // color var
      fill: {
        type: 'gradient',
        gradient: {
          shadeIntensity: 1,
          opacityFrom: 0.7,
          gradientToColors: ['oklch(var(--b1))'],
          opacityTo: 0.3,
          stops: [0, 90, 100]
        }
      },
      xaxis: {
        type: 'category',
        tickPlacement: 'on',
        categories: [
          '1 March 2024',
          '2 March 2024',
          '3 March 2024',
          '4 March 2024',
          '5 March 2024',
          '6 March 2024',
          '7 March 2024',
          '8 March 2024',
          '9 March 2024',
          '10 March 2024',
          '11 March 2024',
          '12 March 2024'
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
            colors: 'oklch(var(--bc) / 0.9)',
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
            colors: 'oklch(var(--bc) / 0.9)',
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
          formatter: value => `${value >= 1000 ? `${value / 1000}k` : value}`
        },
        custom: function (props) {
          const { categories } = props.ctx.opts.xaxis
          const { dataPointIndex } = props
          const title = categories[dataPointIndex].split(' ')
          const newTitle = `${title[0]} ${title[1]}`

          return buildTooltip(props, {
            title: newTitle,
            mode,
            valuePrefix: '',
            hasTextLabel: true,
            markerExtClasses: 'bg-warning',
            wrapperExtClasses: ''
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
                colors: 'oklch(var(--bc) / 0.9)'
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
                  colors: 'oklch(var(--bc) / 0.9)'
                },
                formatter: value => (value >= 1000 ? `${value / 1000}k` : value)
              }
            }
          }
        }
      ]
    }))
    // Apex Single Area Chart (End)
   })()
})




  window.addEventListener("livewire:navigated", () => {
    ;(function () {
      buildChart("#apex-column-bar-chart", mode => ({
        chart: {
          type: "bar",
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
            name: "Investment",
            data: [25000, 39000, 65000, 45000, 79000, 80000, 69000, 63000, 60000, 66000, 90000, 78000]
          }
        ],
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "30px"
          }
        },
        legend: {
          show: false
        },
        dataLabels: {
          enabled: false
        },
        colors: ["oklch(var(--p))", "oklch(var(--b1))"],
        xaxis: {
          categories: [
            "Cook",
            "Erin",
            "Jack",
            "Will",
            "Gayle",
            "Megan",
            "John",
            "Luke",
            "Ellis",
            "Mason",
            "Elvis",
            "Liam"
          ],
          axisBorder: {
            show: false
          },
          axisTicks: {
            show: false
          },
          labels: {
            style: {
              colors: "oklch(var(--bc) / 0.9)",
              fontSize: "12px",
              fontWeight: 400
            }
          }
        },
        yaxis: {
          labels: {
            align: "left",
            minWidth: 0,
            maxWidth: 140,
            style: {
              colors: "oklch(var(--bc) / 0.9)",
              fontSize: "12px",
              fontWeight: 400
            },
            formatter: value => (value >= 1000 ? `${value / 1000}k` : value)
          }
        },
        states: {
          hover: {
            filter: {
              type: "darken",
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
              wrapperExtClasses: "min-w-28",
              labelDivider: ":",
              labelExtClasses: "ms-2"
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
                  columnWidth: "10px"
                }
              },
              stroke: {
                width: 8
              },
              labels: {
                style: {
                  colors: 'oklch(var(--bc) / 0.9)',
                  fontSize: "10px"
                },
                formatter: title => title.slice(0, 3)
              },
              yaxis: {
                labels: {
                  align: "left",
                  minWidth: 0,
                  maxWidth: 140,
                  style: {
                    colors: 'oklch(var(--bc) / 0.9)',
                    fontSize: "10px"
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
      buildChart("#apex-multiple-line-charts", mode => ({
        chart: {
          height: 350,
          type: "line",
          toolbar: {
            show: false
          },
          zoom: {
            enabled: false
          }
        },
        series: [
          {
            name: "Eric",
            data: [0, 17000, 35000, 23000, 40000]
          },
          {
            name: "John",
            data: [0, 15000, 19000, 32500, 27000]
          },
          {
            name: "Gwen",
            data: [0, 12000, 16000, 20000, 30000]
          }
        ],
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: "straight",
          width: [4, 4, 4]
        },
        title: {
          show: false
        },
        legend: {
          show: true,
          position: "top",
          horizontalAlign: "right",
          labels: {
            useSeriesColors: true
          },
          markers: {
            offsetY: 2
          }
        },
        grid: {
          strokeDashArray: 0,
          borderColor: "oklch(var(--bc) / 0.4)",
          padding: {
            top: 0,
            right: 0,
            bottom: 10
          }
        },
        colors: ["oklch(var(--p))", "oklch(var(--su))", "oklch(var(--er))"],
        xaxis: {
          type: "category",
          categories: ["1 January 2024", "1 February 2023", "1 March 2023", "1 April 2023", "1 May 2023"],
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
            offsetY: 5,
            style: {
              colors: "oklch(var(--bc) / 0.9)",
              fontSize: "12px",
              fontWeight: 400
            },
            formatter: title => {
              let t = title

              if (t) {
                const newT = t.split(" ")
                t = `${newT[0]} ${newT[1].slice(0, 3)}`
              }

              return t
            }
          }
        },
        yaxis: {
          min: 0,
          max: 40000,
          tickAmount: 4,
          labels: {
            align: "left",
            minWidth: 0,
            maxWidth: 140,
            style: {
              colors: "oklch(var(--bc) / 0.9)",
              fontSize: "12px",
              fontWeight: 400
            },
            formatter: value => (value >= 1000 ? `${value / 1000}k` : value)
          }
        },
        tooltip: {
          custom: function (props) {
            const { categories } = props.ctx.opts.xaxis
            const { dataPointIndex } = props
            const title = categories[dataPointIndex].split(" ")
            const newTitle = `${title[0]} ${title[1]}`

            return buildTooltip(props, {
              title: newTitle,
              mode,
              hasTextLabel: true,
              wrapperExtClasses: "min-w-36",
              labelDivider: ":",
              labelExtClasses: "ms-2"
            })
          }
        }
      }))
    })()
  })
