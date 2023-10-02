<div class="card-header">
    <div class="col-12 pt-2 pb-2">
        <table class="w-100">
            <tr>
                <td width="25%">
                    <button class="btn btn-sm btn-success" onclick="paging('prev')"><span class="fas fa-arrow-circle-left"></span> Prev</button>
                    <input type="hidden" value="1" id="paging">
                </td>
                <td align="center">
                    <div id="jumlah_data" class="text-bold"></div>
                </td>
                <td width="25%">
                    <button class="btn btn-sm btn-success float-right" onclick="paging('next')">Next <span class="fas fa-arrow-circle-right"></span></button>
                </td>
            </tr>
        </table>
    </div>
</div>