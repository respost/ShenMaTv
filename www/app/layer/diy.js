function openurl(url,notw,noth) {
alert(url);
  layer.open({
    type: 1,
    area: [notw+'px', noth+'px'], //¿í¸ß
    content: '<iframe src="'+url+'" frameborder="0" scrolling="no" width="'+notw+'" height="'+noth+'"></iframe>'
   });
}

function openurla(url,title,notw,noth) {
layer.open({
    type: 2,
    title: title,
    shadeClose: true,
    shade: 0.8,
    area: [notw+'px', noth+'px'],
    content: url //iframeµÄurl
});
}