
// Loads a Vuzit viewer
function vuzitViewer()
{
  for(var i = 0; i < ___vuz.length; i++)
  {
    var options = ___vuz[i];
    vuzit.Base.apiKeySet(options.pub_key); 
    var loadOptions = { 
      signature: options.signature,
      timestamp: options.timestamp
    };
    if(options.include.length > 0) {
      loadOptions["includedPages"] = options.include;
    }
    if(options.watermark.length > 0) {
      loadOptions["watermark"] = options.watermark;
    }
  
    var viewer = null;
    if(options.id.length > 0) {
      viewer = vuzit.Viewer.fromId(options.id, loadOptions);
    } else {
      viewer = vuzit.Viewer.fromUrl(options.url, loadOptions);
    }
    var displayOptions = {
      zoom: options.zoom,
      page: options.page
    };
    viewer.display(document.getElementById(options.div), displayOptions);
  }
};
