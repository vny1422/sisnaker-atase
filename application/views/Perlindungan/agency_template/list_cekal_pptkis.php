<div class="pull-right" style="padding-bottom: 20px"><strong>Jumlah Total PPTKIS Tercekal :</strong> {{cekalpptkis_q.length}}   </div>
<table st-table="cekalpptkis" st-safe-src="cekalpptkis_q" class="table table-striped table-hover table-bordered">
    <thead>
        <tr class="btn-primary">
            <th class="text-center" style="width:5%">No</th>
            <th class="text-center" style="width:auto">Nama PPTKIS</th>
            <th class="text-center" style="width:25%">Penanggung Jawab</th>
            <th class="text-center" style="width:15%">Awal Cekal</th>
            <th class="text-center" style="width:15%">Akhir Cekal</th>
        </tr>
        <tr class="text-center">
            <th></th>
            <th><input st-search="ppnama" placeholder="nama pptkis" class="input-sm form-control" type="search"/></th>
            <th><input st-search="pppngjwb" placeholder="penanggung jawab" class="input-sm form-control" type="search"/></th>
            <th><input st-search="cpstart" placeholder="awal cekal" class="input-sm form-control" type="search"/></th>
            <th><input st-search="cpend" placeholder="akhir cekal" class="input-sm form-control" type="search"/></th>
        </tr>
    </thead>
    <tbody class="table-hover " >
        <tr ng-repeat="pt in cekalpptkis" ng-cloak>
            <td class="text-center">{{pt.index}}</td>
            <td ><a ng-click="detail_pptkis(pt.ppkode)" style="cursor: pointer">{{pt.ppnama}}</a></td>
            <td >{{pt.pppngjwb}}</td>
            <td class="text-center">{{pt.cpstart}}</td>
            <td class="text-center">{{pt.cpend || "-"}}</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="text-center">
                <div st-pagination="" st-items-by-page="10" st-template="<?php echo assets_url() ?>/template/custom.pagination.html"></div>
            </td>
        </tr>

    </tfoot>
</table>
