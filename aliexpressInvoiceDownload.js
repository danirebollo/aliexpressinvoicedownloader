function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", theUrl, false);
    xmlHttp.send(null);
    return xmlHttp.responseText;
}

for (var i = 0; i < idsArray.length; i += 1)
{
    var orderid = JSON.parse(httpGet("https://trade.aliexpress.com/ajax/invoice/queryInvoiceIdAjax.htm?orderIds=" + idsArray[i]));
    var url = "https://trade.aliexpress.com/ajax/invoice/invoiceExportAjax.htm?invoiceId=" + orderid + "&orderId=" + idsArray[i];
    console.log("Index '" + i + "':: invoiceId: " + idsArray[i] + ", orderid: " + orderid+". URL: "+url);
    window.open(url, '_blank');

    /* old approach calling button */  
    //var element = document.querySelector('button[orderid="'+idsArray[i]+'"][button_action="downloadInvoice"]');
    //element.click();
}