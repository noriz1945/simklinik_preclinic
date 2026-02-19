//var baseUrl = '/zia_aesthetic/'; 
var baseUrl = window.location.origin + '/' + window.location.pathname.split ('/') [1] + '/';

 //Format uang
 formatMoney();
  function formatMoney(amount, decimalCount = 0/*ganti 2 kalo mau pake decimal*/, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
  const negativeSign = amount < 0 ? "-" : "";
  let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
  let j = (i.length > 3) ? i.length % 3 : 0;
    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
 };
 //End Format uang


 $( document ).ready(function() {
    graphset();
    graphset_farmasi();
    datagraph_3();
    datagraph_4();
 });

 $('.tgl_1_dash_1').change(function() {
    graphset();
 });

 $('.tgl_1_dash_2').change(function() {
    graphset_farmasi();
 });

 $('.selmst_bulan').change(function() {
    datagraph_3();
 });

 $('.selmst_tahun').change(function() {
    datagraph_3();
 });

 $('.farm_selmst_bulan').change(function() {
    datagraph_4();
 });

 $('.farm_selmst_tahun').change(function() {
    datagraph_4();
 });

 function graphset(){

  var tgl_1 = $('.tgl_1_dash_1').val();

    let d_1 = new Date(tgl_1);
    let d_2 = new Date(tgl_1);
    let d_3 = new Date(tgl_1);
    let d_4 = new Date(tgl_1);
    let d_5 = new Date(tgl_1);
    let d_6 = new Date(tgl_1);
    let d_7 = new Date(tgl_1);

    d_1.setDate(d_1.getDate() - 0);
    d_2.setDate(d_2.getDate() - 1);
    d_3.setDate(d_3.getDate() - 2);
    d_4.setDate(d_4.getDate() - 3);
    d_5.setDate(d_5.getDate() - 4);
    d_6.setDate(d_6.getDate() - 5);
    d_7.setDate(d_7.getDate() - 6);

    const event = new Date(Date.UTC(2012, 11, 20, 3, 0, 0));
    const options = {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    };

    var tgl_d_1 = d_1.toLocaleDateString('id-DE', options);
    var tgl_d_2 = d_2.toLocaleDateString('id-DE', options);
    var tgl_d_3 = d_3.toLocaleDateString('id-DE', options);
    var tgl_d_4 = d_4.toLocaleDateString('id-DE', options);
    var tgl_d_5 = d_5.toLocaleDateString('id-DE', options);
    var tgl_d_6 = d_6.toLocaleDateString('id-DE', options);
    var tgl_d_7 = d_7.toLocaleDateString('id-DE', options);


    $.ajax({
        url : baseUrl+"home/home/data_poli_umum",
        method : "POST",
        data : {tgl_1:tgl_1},
        async : true,
        dataType : 'json',
        success: function(datares){ 

            if(datares[0].day_1==null){ var day_0 =0;}else{ var day_0 = datares[0].day_1; }
            if(datares[0].day_2==null){ var day_1 =0;}else{ var day_1 = datares[0].day_2; }
            if(datares[0].day_3==null){ var day_2 =0;}else{ var day_2 = datares[0].day_3; }
            if(datares[0].day_4==null){ var day_3 =0;}else{ var day_3 = datares[0].day_4; }
            if(datares[0].day_5==null){ var day_4 =0;}else{ var day_4 = datares[0].day_5; }
            if(datares[0].day_6==null){ var day_5 =0;}else{ var day_5 = datares[0].day_6; }
            if(datares[0].day_7==null){ var day_6 =0;}else{ var day_6 = datares[0].day_7; }

            var chart = c3.generate({
              data: {
                x : 'x',
                  columns: [
                      ['x', tgl_d_7, tgl_d_6, tgl_d_5, tgl_d_4, tgl_d_3, tgl_d_2, tgl_d_1],
                      ['POLIKLINIK', day_6, day_5, day_4, day_3, day_2, day_1, day_0]
                  ], 
                  types: {
                    'POLIKLINIK': 'bar'
                  },
                  labels: true
              },
              point: {
                  show: true
              },
              grid: {
                  y: {
                      lines: [{value: 0}]
                  }
              },
              axis: {
                  x: {
                      type: 'category' // this needed to load string x value
                  }
              }
          });
        }//success poli
    }); //poli

    //}
 }

 function graphset_farmasi(){

  var tgl_1 = $('.tgl_1_dash_2').val();

  let d_1 = new Date(tgl_1);
  let d_2 = new Date(tgl_1);
  let d_3 = new Date(tgl_1);
  let d_4 = new Date(tgl_1);
  let d_5 = new Date(tgl_1);
  let d_6 = new Date(tgl_1);
  let d_7 = new Date(tgl_1);

  d_1.setDate(d_1.getDate() - 0);
  d_2.setDate(d_2.getDate() - 1);
  d_3.setDate(d_3.getDate() - 2);
  d_4.setDate(d_4.getDate() - 3);
  d_5.setDate(d_5.getDate() - 4);
  d_6.setDate(d_6.getDate() - 5);
  d_7.setDate(d_7.getDate() - 6);

  const event = new Date(Date.UTC(2012, 11, 20, 3, 0, 0));
  const options = {
  weekday: 'long',
  year: 'numeric',
  month: 'long',
  day: 'numeric',
  };

  var tgl_d_1 = d_1.toLocaleDateString('id-DE', options);
  var tgl_d_2 = d_2.toLocaleDateString('id-DE', options);
  var tgl_d_3 = d_3.toLocaleDateString('id-DE', options);
  var tgl_d_4 = d_4.toLocaleDateString('id-DE', options);
  var tgl_d_5 = d_5.toLocaleDateString('id-DE', options);
  var tgl_d_6 = d_6.toLocaleDateString('id-DE', options);
  var tgl_d_7 = d_7.toLocaleDateString('id-DE', options);


  const nFormat = new Intl.NumberFormat();
  $.ajax({
      url : baseUrl+"home/home/data_penjualan_obat",
      method : "POST",
      data : {tgl_1:tgl_1},
      async : true,
      dataType : 'json',
      success: function(datares){ 

          if(datares.day_1==null){ var day_0 =0;}else{ var day_0 = datares.day_1; }
          if(datares.day_2==null){ var day_1 =0;}else{ var day_1 = datares.day_2; }
          if(datares.day_3==null){ var day_2 =0;}else{ var day_2 = datares.day_3; }
          if(datares.day_4==null){ var day_3 =0;}else{ var day_3 = datares.day_4; }
          if(datares.day_5==null){ var day_4 =0;}else{ var day_4 = datares.day_5; }
          if(datares.day_6==null){ var day_5 =0;}else{ var day_5 = datares.day_6; }
          if(datares.day_7==null){ var day_6 =0;}else{ var day_6 = datares.day_7; }

          var chart = c3.generate({
            //bindto: '#chart_farmasi',
            bindto: '#chart_farmasi',
            data: {
              x : 'x',
                columns: [
                    ['x', tgl_d_7, tgl_d_6, tgl_d_5, tgl_d_4, tgl_d_3, tgl_d_2, tgl_d_1],
                    ['PENJUALAN OBAT', day_6, day_5, day_4, day_3, day_2, day_1, day_0],
                ], 
                types: {
                  'PENJUALAN OBAT': 'bar',
                },
                labels: true,
            },
            point: {
                show: true
            },
            grid: {
                y: {
                    lines: [{value: 0}]
                }/*,
                x: {
                  lines: [
                      {value: 1, text: 'Label 1'},
                      {value: 2, text: 'Label 3'},
                      {value: 3, text: 'Lable 4.5'},
                      {value: 4, text: 'Lable 4.5'},
                      {value: 5, text: 'Lable 4.5'},
                      {value: 6, text: 'Lable 4.5'},
                      {value: 7, text: 'Lable 4.5'}
                  ]
              }*/
            },
            axis: {
                x: {
                    type: 'category'//, // this needed to load string x value
                    /*tick: {
                      format: d3.format("Rp,")
      //                format: function (d) { return "$" + d; }
                  }*/
                }
            }
        });
      }//success poli
  }); //poli

  //}
}


  $('#tgl_dash_1').datepicker({ dateFormat: 'yy-mm-dd' });
  $('#tgl_dash_2').datepicker({ dateFormat: 'yy-mm-dd' });

  
  function datagraph_3(){

    var set_1 = $('.selmst_bulan').val();
    var set_2 = $('.selmst_tahun').val();
 
    $.ajax({
      url : baseUrl+"/home/graphmanajemen_3",
      method : "POST",
      data : {set_1:set_1,set_2:set_2},
      async : true,
      dataType : 'json',
      success: function(datares){
        var i;
        var hari = [];
        var jumlah = [];
        for (i = 1; i <= datares.length; i++) {
          hari.push(i);
          jumlah.push(datares[i]);
        }
  
  
  
    //var tahun = $('#tahun_graph').val();
    var chartDom = document.getElementsByClassName('graph_1')[0];
    var myChart = echarts.init(chartDom);
    var option;
    option = {
      tooltip: {
        trigger: 'axis',
        axisPointer: {
          type: 'cross',
          crossStyle: {
            color: '#999'
          }
        }
      },
      toolbox: {
        feature: {
          dataView: { show: true, readOnly: false },
          magicType: { show: true, type: ['line', 'bar'] },
          restore: { show: true },
          saveAsImage: { show: true }
        }
      },
      legend: {
        data: ['Jumlah Kunjungan']
      },
      xAxis: [
        {
          type: 'category',
          data: hari,
          axisPointer: {
            type: 'shadow'
          }
        }
      ],
      yAxis: [
        {
          type: 'value',
          name: 'Jumlah Kunjungan',

          interval: 50,
          axisLabel: {
            formatter: '{value}'
          }
        }
      ],
      series: [
        {
          name: 'Jumlah Kunjungan',
          type: 'bar',
          tooltip: {
            valueFormatter: function (value) {
              return value;
            }
          },
          data: jumlah
        }
      ]
    };
    myChart.setOption(option);  
  }
  });
  }

  function datagraph_4(){

    var set_1 = $('.farm_selmst_bulan').val();
    var set_2 = $('.farm_selmst_tahun').val();
 
    $.ajax({
      url : baseUrl+"/home/graphmanajemen_4",
      method : "POST",
      data : {set_1:set_1,set_2:set_2},
      async : true,
      dataType : 'json',
      success: function(datares){
        var i;
        var hari = [];
        var jumlah = [];
        for (i = 1; i <= datares.length; i++) {
          hari.push(i);
          jumlah.push(datares[i]);
        }
  
  
  
    //var tahun = $('#tahun_graph').val();
    var chartDom = document.getElementsByClassName('graph_2')[0];
    var myChart = echarts.init(chartDom);
    var option;
    option = {
      tooltip: {
        trigger: 'axis',
        axisPointer: {
          type: 'cross',
          crossStyle: {
            color: '#999'
          }
        }
      },
      toolbox: {
        feature: {
          dataView: { show: true, readOnly: false },
          magicType: { show: true, type: ['line', 'bar'] },
          restore: { show: true },
          saveAsImage: { show: true }
        }
      },
      legend: {
        data: ['Penjualan Obat']
      },
      xAxis: [
        {
          type: 'category',
          data: hari,
          axisPointer: {
            type: 'shadow'
          }
        }
      ],
      yAxis: [
        {
          type: 'value',
          name: 'Penjualan Obat',

          interval: 50,
          axisLabel: {
            formatter: '{value}'
          }
        }
      ],
      series: [
        {
          name: 'Penjualan Obat',
          type: 'bar',
          tooltip: {
            valueFormatter: function (value) {
              return "Rp. "+formatMoney(value,0);
            }
          },
          data: jumlah,
    /*markPoint: {
      data: [
        {type: "min"},
        {type: "max"},
        {type: "average"}
      ],
      symbol: "triangle"
    },*/
        }
      ]
    };
    myChart.setOption(option);  
  }
  });
  }
  