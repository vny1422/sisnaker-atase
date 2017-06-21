var proto = window.location.protocol;

var formApp = angular.module('FormApp', ['angular-bootstrap-select','ngFileUpload','ngAlertify','ngSanitize']);

formApp.filter('unsafe', function($sce) { return $sce.trustAsHtml; });

formApp.controller('FormController',['$scope','FormService','LookupService','Upload', '$rootScope','alertify','$timeout','$sce',
                                     function($scope,FormService,LookupService,Upload,$rootScope,alertify,$timeout,$sce,$http){
    angular.element(document).ready(function () {
        var l = $("#search-paspor").ladda();
        var tkiid = null;
        var json = null;
        var json2 = null;
        var data2 = null;

        $scope.searchpaspor = function (){
            l.ladda('start');

            $.post("Kasus/checkPaspor", {paspor: $('#inputpaspor').val()}, function(xml,status){
                l.ladda('stop');
                json = $.parseJSON(xml);

                $.post("Endorsement/requestTKI", {paspor: $('#inputpaspor').val(), jpid: ''}, function(xml,status){
                  json2 = $.parseJSON(xml);

                  $scope.$apply(function(){
                    if(json == null && json2 == 0)
                    {
                        alert("Passport not found. Please insert manually.");
                    }
                    else if (json == null && json2 != 0){
                        data2 = json2.data;

                        $scope.formdata['namatki'] = data2.TKI_TKINAME;
                        $scope.formdata['jk'] = data2.TKI_TKIGENDER;
                        $scope.formdata['alamatID'] = data2.TKI_TKIADDRESS;
                        $scope.formdata['agensiTW'] = data2.TKI_PJTKADESC;
                        $scope.formdata['pptkis'] = data2.TKI_PJTKIDESC;
                        $scope.formdata['majikan'] = data2.TKI_VISAMAJIKANNAME;

                        tkiid = data2.TKI_TKIID;
                    }
                    else if (json != null && json2 == 0){
                        $scope.formdata['namatki'] = json.namatki;
                        $scope.formdata['jk'] = json.jk;
                        $scope.formdata['alamatID'] = json.alamatindonesia;
                        $scope.formdata['alamatTW'] = json.alamattaiwan;
                        $scope.formdata['pekerjaan'] = json.namajenispekerjaan;
                        $scope.formdata['agensiTW'] = json.agensi;
                        $scope.formdata['cpagensiTW'] = json.cpagensi;
                        $scope.formdata['telpagensi'] = json.teleponagensi;
                        $scope.formdata['pptkis'] = json.pptkis;
                        $scope.formdata['majikan'] = json.majikan;

                        tkiid = json.tkiid;
                    }
                    else if (json != null && json2 != 0){
                        data2 = json2.data;

                        $('#namatkilokal').html(json.namatki);
                        $('#jklokal').html(json.jk);
                        $('#alamatidlokal').html(json.alamatindonesia);
                        $('#alamatlokal').html(json.alamattaiwan);
                        $('#pekerjaanlokal').html(json.namajenispekerjaan);
                        $('#agensilokal').html(json.agensi);
                        $('#kontakagensilokal').html(json.cpagensi);
                        $('#telpagensilokal').html(json.teleponagensi);
                        $('#pptkislokal').html(json.pptkis);
                        $('#majikanlokal').html(json.majikan);

                        $('#namatkibnp2tki').html(data2.TKI_TKINAME);
                        $('#jkbnp2tki').html(data2.TKI_TKIGENDER);
                        $('#alamatidbnp2tki').html(data2.TKI_TKIADDRESS);
                        $('#alamatbnp2tki').html('-');
                        $('#pekerjaanbnp2tki').html('-');
                        $('#agensibnp2tki').html(data2.TKI_PJTKADESC);
                        $('#kontakagensibnp2tki').html('-');
                        $('#telpagensibnp2tki').html('-');
                        $('#pptkisbnp2tki').html(data2.TKI_PJTKIDESC);
                        $('#majikanbnp2tki').html(data2.TKI_VISAMAJIKANNAME);

                        $("#modaltki").modal('show');
                    }
                });       
              });
            });
        };

        $("#btnPilih").click( function(e) {
          e.preventDefault();
          $scope.$apply(function(){
              if($("#tablokal").hasClass("active")){
                $scope.formdata['namatki'] = json.namatki;
                $scope.formdata['jk'] = json.jk;
                $scope.formdata['alamatID'] = json.alamatindonesia;
                $scope.formdata['alamatTW'] = json.alamattaiwan;
                $scope.formdata['pekerjaan'] = json.namajenispekerjaan;
                $scope.formdata['agensiTW'] = json.agensi;
                $scope.formdata['cpagensiTW'] = json.cpagensi;
                $scope.formdata['telpagensi'] = json.teleponagensi;
                $scope.formdata['pptkis'] = json.pptkis;
                $scope.formdata['majikan'] = json.majikan;

                tkiid = json.tkiid;
            } else {
                data2 = json2.data;

                $scope.formdata['namatki'] = data2.TKI_TKINAME;
                $scope.formdata['jk'] = data2.TKI_TKIGENDER;
                $scope.formdata['alamatID'] = data2.TKI_TKIADDRESS;
                $scope.formdata['agensiTW'] = data2.TKI_PJTKADESC;
                $scope.formdata['pptkis'] = data2.TKI_PJTKIDESC;
                $scope.formdata['majikan'] = data2.TKI_VISAMAJIKANNAME;

                tkiid = data2.TKI_TKIID;
            }
        });
        $("#modaltki").modal('hide');
    });

    /// menu label
    $scope.menu = [{title:"Input Kasus",btn:"Simpan kasus"},{title:"Edit Kasus",btn:"Update kasus"}];
    $scope.menulabel = 0;
    $scope.working = 0;
    $scope.disableAll = false;
    $scope.adminOnly = false;
    /// form data
    $scope.formdata = {};
    $scope.formlain = {};
    // id siap
    $scope.formdata.adid = parseInt(siap);
    ///selectoptions data
    $scope.sop = {};
    ///date limiter per tanggal 5 dibulan yang sama
    $scope.limitDate = moment().format("YYYY/MM")+"/05";
    $scope.limitDate = moment($scope.limitDate,"YYYY/MM/DD");
    $scope.dateWarning = "<b>Tanggal melewati batas aduan bulan ini </br>("+$scope.limitDate.format('D-MMMM-YYYY')+") atau lebih lama dari 1 bulan terakhir</b>"+
                            "<ul style='text-align:left'><li>Aduan akan disimpan menggunakan tanggal hari ini.</li>"+
                            "<li>Tanggal yang dipilih akan dicantuman pada <b>Deskripsi masalah</b></li></ul>";
    $scope.deltatoday = moment().diff($scope.limitDate,'days');
    $scope.dateDis = false;
    $scope.onEdit = false;

    ///
    $scope.reuse = false;

    alertify.alert("Data simpati telah terhubung dengan Crisis-Center BNP2TKI. Pastikan kelengkapan dan akurasi data.");

    /////////////////////////////////
    ////// grab important parameter
    FormService.getOptions().success(function(res){
        //console.log(res);
        $scope.sop['klasifikasi'] = angular.copy(res.klasifikasi);
        $scope.sop['pekerjaan'] = angular.copy(res.worktype);
        $scope.sop['petugas'] = angular.copy(res.petugas);
        $scope.sop['media'] = angular.copy(res.media);

        $scope.self = FormService.getCRX();

        //console.log($scope.self);

        if ($scope.self[3]==='new') {
            //// new
            $scope.formdata['pekerjaan']    = angular.copy($scope.sop['pekerjaan'].slice(-1)[0]['idjenis']);
            $scope.formdata['media']        = angular.copy($scope.sop['media'][0]['idmedia']);
            $scope.formdata['klasifikasi']  = angular.copy($scope.sop['klasifikasi'][0]['idklasifikasi']);
            /// for petugas
            if ($scope.self[1]==1) {
                $scope.formdata['petugas']  = angular.copy($scope.sop['petugas'][0]['username']);
            }
            else{
                 $scope.formdata['petugas'] = $scope.self[0];
                 document.getElementById("pilihpetugas").disabled = true;
            }

            $scope.formdata['eskalasi'] = "KDEI";

            $scope.retrieveSIAP(true);
            $scope.formdata['ofuname'] = $scope.self[0];
            $scope.formdata['ofname'] = $scope.self[2];
            /// set menu and render form
            $scope.menulabel = $scope.menu[0];
            $scope.dateEdit = false;
            $scope.adminOnly = false;
        }
        else{
            /// existing (edit)
            FormService.getData(parseInt($scope.self[3])).success(function(res){
                //////////copy data
                $scope.formdata = angular.copy(res);
                //////// sanitize
                angular.forEach(res,function(value,key){
                    ///decode html if (htmlspecial_character is detected)
                    if (key!='filelist' && key!='shelter' && key!='tindaklanjutlama'  && key!='tindaklanjutBNP' && value!=null) {
                        var dres = value.match(/&(?:[a-z]+|#x?\d+)/g);
                        if (dres != null ) {
                            $scope.formdata[key] = FormService.htmlDecode(value);
                        }
                    }
                });
                $scope.retrieveSIAP(false);     /// retrieve SIAP tanpa override petugas karena bisa jadi kasus ditangani petugas lain meski tujuan disposisi berbeda
                $scope.formdata['ofuname'] = $scope.self[0];
                $scope.formdata['ofname'] = $scope.self[2];
                /// set menu and render form
                $scope.menulabel = $scope.menu[1];
                $scope.dateEdit = true;
                $scope.adminOnly = false;
                $scope.onEdit  =true;
                ////
                if ($scope.self[1] != "1") {
                    //bukan admin
                    $scope.adminOnly = true;
                    if ($scope.formdata['petugas'] != $scope.self[0]) {
                        $scope.disableAll = true;
                    }
                }
            });
        }

    });

    ///// grab siap
    $scope.retrieveSIAP = function(override){
        if ($scope.formdata.adid > 0) {
            FormService.getSiap($scope.formdata.adid).success(function(res){
                //console.log(res);
                $scope.siap = angular.copy(res);
                if(override==true) {
                    $scope.formdata.petugas = angular.copy(res.pjuser);
                }
            });
        }
    }

    ////////////////////////////////
    ////// validator tanggal pengaduan
    $scope.dateAduVerify = function(){
        var entryDigit = moment($scope.formdata.tanggalpengaduan,"YYYY/MM/DD");
        var delta = entryDigit.diff($scope.limitDate,'days');

        var olderdate = moment((moment().format("YYYY/MM")+"/01"), "YYYY/MM/DD");
        olderdate = olderdate.diff(moment($scope.formdata.tanggalpengaduan,"YYYY/MM/DD"),'months',true);

        //console.log(olderdate);

        if ((delta<-4 && $scope.deltatoday > 0) || (olderdate >1)) {
            //tanggal dimasukan sebelum tgl 5 bulan berjalan dan tanggal form setelah tanggal 5
            alertify.confirm($scope.dateWarning,
                function(){
                    $scope.formdata.tanggalpengaduan = moment().format("YYYY/MM/DD");
                    entryDigit = entryDigit.format("YYYY/MM/DD");
                    /// if prev desc available
                    var prevdesc = $scope.formdata.permasalahan;
                    if (angular.isUndefined(prevdesc)) {
                        prevdesc = "";
                    }
                    /// workaround for renewing deskripsi masalah
                    $timeout(function(){
                        $scope.formdata.permasalahan = "-- Pengaduan Diterima : "+entryDigit+" --\n"+prevdesc;
                    },100);
                },function(){
                    /// workaround for renewing deskripsi masalah
                    $timeout(function(){
                        $scope.formdata.tanggalpengaduan = '';
                    },100);
            });
        }
    };


    /////////////////////////////////
    ////// data TKI lookup

    /////////////////////////////////
    ////// data TKI lookup
    $scope.lookup = function(){
        if ($scope.formdata['paspor']=='') return;
        $('#windowPaspor').modal('show');
        $rootScope.$emit('pasporLookup',$scope.formdata['paspor']);
    }
    ////// copy data from tki lookup
    $rootScope.$on("salinDataTKI", function(evt,args){
        var buff = args;
        if (buff['pekerjaan'] == '') {
            /// set to tidak diketahui jika ''
            buff['pekerjaan'] = "0";
        }
        else{
            /// set to correct naming versi simpati
            buff['pekerjaan'] = buff['pekerjaan']['idjenis'];
        }
        /// push to formdata
        angular.forEach(buff, function(value,key){
            $scope.formdata[key] = value;
        });
        //
        $('#windowPaspor').modal('hide');
    });
    ////// paspor number formatting (regex)
    $scope.paspor_regex = function(){
        var str = $scope.formdata['paspor'];
        if(str != null)
        {
            $scope.formdata['paspor'] = str.replace(/[^a-zA-Z0-9]/g, "").toUpperCase();
        }
    }

    /////////////////////////////////
    ////// new or edit SH record
    $scope.neweditSH = function(id){
        //console.log("sh"+id);

        /// newedit sh
        $('#windowShelter').modal('show');
        if (id==-1) {   //new
            $rootScope.$emit('shelterEmpty',[$scope.self[4]]);
        }
        else{       //edit
          console.log($scope.formdata['shelter'][id]);

            $rootScope.$emit('shelterExist',[id,$scope.formdata['shelter'][id],$scope.self[4]]);
        }
    };
    ////// remove SH record
    $scope.removeSH = function(id){
        alertify.confirm("Anda akan menghapus satu record data shelter. Lanjutkan?",function(){
            $timeout(function(){
                $scope.formdata['shelter'].splice(id,1)
            },50);
        })
    };
    ///// request on SH record from another controller
    $rootScope.$on("dataShelter", function(evt,args){
        if((args===0)==false){
            if (args[1]==-1) {  //baru
                if ($scope.formdata.shelter===undefined) {
                    $scope.formdata['shelter'] = [];
                }
                $scope.formdata['shelter'].push(args[0]);
            }
            else{  // update
                $scope.formdata['shelter'][args[1]] = angular.copy(args[0]);
            }
        }
        $('#windowShelter').modal('hide');
    });

    ///////////////////////////////////
    $scope.toberemoved  = [];
    ////// newfile remove
    $scope.newfileremove = function (id){
        $scope.newfile.splice(id,1);
    }
     //// existed file remove
    $scope.existfileremove = function (id){
        var k = $scope.formdata.filelist.splice(id,1);
        $scope.toberemoved.push(k[0]);
    }
    /// cancel file remove
    $scope.cancelfileremove = function (id){
        var k = $scope.toberemoved.splice(id,1);
        $scope.formdata.filelist.push(k[0]);
    }

    ///////////////////////////////////
    $scope.disablesubmit = false;
    ////// Execute upload
    $scope.submit_form = function(){
        $scope.disablesubmit = true;
        $('#modal_working').modal('show');
        $scope.working = 0;
        //
        if ($scope.self[3]==='new') {
           var targetURL = mainURI+"kasus/save_entry";
        }
        else {
            var targetURL = mainURI+"edit/update_entry/"+$scope.self[3];
        }
        //
        if ($scope.formdata['statusmasalah'] == 2 && $scope.formdata['tglpenyelesaian']=="") {
            $scope.formdata['tglpenyelesaian'] = moment().format("YYYY/MM/DD");
        }

        var upload = Upload.upload({
            url: targetURL,
            fields: {'formdata': Upload.json($scope.formdata),'formlain': Upload.json($scope.formlain)},
            file: $scope.newfile
        });

        upload.then(function(resp) {
            // file is uploaded successfully
            $scope.working = 1;
            console.log(resp);
            if ($scope.reuse==true) {
                $scope.disablesubmit = false;
                $scope.formdata['namatki'] = null;
                $scope.formdata['paspor'] = null;
                $scope.formdata['arc'] = null;
            }
        }, function(resp) {
            // handle error
            $scope.working = -1;
            console.log(resp);
        });
    }

    ///////////////////////////////////
    });
}]);

formApp.controller('PasporController',['$scope','LookupService', '$rootScope',
                    function($scope,LookupService,$rootScope,$http){
    $scope.Paspor = "";
    $scope.label = LookupService.label();
    $scope.endorse = {};
    $scope.ktkln = {};

    $rootScope.$on('pasporLookup', function(evt,ags){
        $scope.endorse = 1;
        $scope.ktkln = 1;
        $scope.Paspor = ags;
        //code
        LookupService.run(ags).success(function(res){
                console.log(res);
                $scope.ktkln = angular.copy(res[0]);
                $scope.endorse = angular.copy(res[1]);
            });
    });

    $scope.salin = function(src){
        $rootScope.$emit("salinDataTKI", src);
    }

}]);


formApp.controller('ShelterController',['$scope','$interval', '$rootScope','FormService',
                    function($scope,$interval,$rootScope,FormService,$http){
    $scope.idx=-1;
    $scope.shelterform={};

    ///getShelter list
    $scope.shList = {};
    FormService.shelter().success(function(src){
        $scope.shList = angular.copy(src);
    });

    ///set empty if request on empty
    $rootScope.$on('shelterEmpty',function(evt,ags){
        $scope.shelterform={};
        $scope.shelterform['out']="";
        $scope.shelterform['info']="";
        $scope.idx=-1;
        $scope.shelterform.lokasi = $scope.shList[0]; ///init
        if (ags[0] != "1") {
            $scope.forceShelter(ags[0]);
        }
    });
    /// copy data if exist
    $rootScope.$on('shelterExist',function(evt,ags){
        $scope.shelterform=ags[1];
        $scope.idx=ags[0];

        ///weird solution for select menu, but it's work
        $scope.forceShelter(ags[1].lokasi.id);
    });

    /// assign selection
    $scope.forceShelter = function(valx){
        angular.forEach($scope.shList, function(value,key){
            if (value.id == valx) {
                $scope.shelterform.lokasi = $scope.shList[key];
                //console.log(value);
            }
        });
    };

    ////button response
    $scope.save = function(data){
        $rootScope.$emit('dataShelter',[data,$scope.idx]);
    }
    $scope.cancel = function(){
        $rootScope.$emit('dataShelter',0);
    }
}]);

formApp.service('FormService',function($http){
    var curlForm = mainURI+"kasus/getParam";
    var curlShelter = mainURI+"kasus/getShelter";
    var curlEdit = mainURI+"edit/getData"; ////////proto with DEV
    var curlSiap = mainURI+"input/getSiap";
    var crx = crex;
    ///reset crex;
    crex=0;
    crx = crx.split(/---/g);
    // getcrx
    this.getCRX = function(){
      return crx;
    };
    // get form param
    this.getOptions = function(){
        return $http.get(curlForm);
    };
    // get shelter list
    this.shelter = function(){
        return $http.get(curlShelter);
    };
    // get data based on ID for edit
    this.getData = function(idmasalah){
        return $http.get(curlEdit+'/'+idmasalah);
    };
    // get siap data
    this.getSiap = function(idsp){
        return $http.get(curlSiap+'/'+idsp);
    };
    // html decodeing
    this.htmlDecode = function(input){
        var e = document.createElement('div');
        e.innerHTML = input;
        return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
    };
});

formApp.service('LookupService',function($http){
    var curl = mainURI+"input/get_paspor_info";
    // get label
    this.label = function(){
        var labelf = [{key:'namatki',label:'Nama TKI'},
                      {key:'jk',label:'Jenis Kelamin'},
                      {key:'alamatID',label:'Alamat Indonesia'},
                      {key:'alamatTW',label:'Alamat Taiwan'},
                      {key:'pekerjaan',label:'Pekerjaan'},
                      {key:'agensiTW',label:'Agensi'},
                      {key:'cpagensiTW',label:'Kontak Agensi'},
                      {key:'telpagensi',label:'Telepon Agensi'},
                      {key:'pptkis',label:'PPTKIS'},
                      {key:'majikan',label:'Majikan'},
                      {key:'info',label:'Informasi terkait'}];
        return labelf;
    }
    // get form param
    this.run = function(pr){
        return $http.get(curl+'/'+pr);
    };
});
