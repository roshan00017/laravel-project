function convertBsToAd(dateBsId, dateAdId) {
    const regEx = /^\d{4}-\d{2}-\d{2}$/;
    const isvalid = dateBsId;
    if (!isvalid.match(regEx)) {
    } else {
        const arr = isvalid.split("-");
        const bsToAd = NepaliFunctions.ConvertDateFormat(NepaliFunctions.BS2AD({
            year: arr[0],
            month: arr[1],
            day: arr[2]
        }));
        $(dateAdId).val(bsToAd);
    }
}
function convertAdToBs(dateAdId, dateBsId) {
    const regEx = /^\d{4}-\d{2}-\d{2}$/;
    const isvalid = dateAdId;
    if (!isvalid.match(regEx)) {
    } else {
        const arr = isvalid.split("-");
        const adToBs = NepaliFunctions.ConvertDateFormat(NepaliFunctions.AD2BS({
            year: arr[0],
            month: arr[1],
            day: arr[2]
        }));
        $(dateBsId).val(adToBs);
    }
}

function convertBsToAdYear(dateBsId,dateAdId){

    var regEx = /^\d{4}-\d{2}-\d{2}$/;
    var isvalid= dateBsId;
    if(!isvalid.match(regEx)){

    }
    else{
        const arr = isvalid.split("-");
        const str = NepaliFunctions.ConvertDateFormat(NepaliFunctions.BS2AD({
            year: arr[0],
            month: arr[1],
            day: arr[2]
        }));
        const res = str.split("-", 1);
        $(dateAdId).val(res);

    }

}

function convertAdToBsYear(dateAdId,dateBsId){
    // $(dateAdId).val(dateBsId); return false;
    const regEx = /^\d{4}-\d{2}-\d{2}$/;
    const isvalid = dateAdId;
    if(!isvalid.match(regEx)){

    }
    else{
        const arr = isvalid.split("-");
        const str = NepaliFunctions.ConvertDateFormat(NepaliFunctions.AD2BS({
            year: arr[0],
            month: arr[1],
            day: arr[2]
        }));
        const res = str.split("-", 1);
        $(dateBsId).val(res);

    }

}
