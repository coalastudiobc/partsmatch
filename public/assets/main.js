import "./pspdfkit.js";
const baseUrl = `${window.location.protocol}//${window.location.host}/assets/`;
var edited = false;
var previous_annotation_index = "";
var previous_page_index = "";
var instance = await PSPDFKit.load({
    baseUrl,
    container: "#pspdfkit",
    // document: "https://easyannotationbus3.s3.ca-central-1.amazonaws.com/Documents/gP5E74UUhSFICLOPhwKeBulsgXkm10yonvI2oCKg.pdf",
    document: pdf_path_s3,
    styleSheets: [
        baseUrl + "my-pspdfkit.css", // or local CSS file
    ],
    licenseKey: 'eUGrjd7uXZ8pRFE4ExtxuP9ve76MZnS2iYPickoBkdQL0FVtLYeRllOBVZWX_mccr1vI0Ky71fu3061ubEGt9D-fvs22rcNXk89NXE8qt4MRXPTBt-Qp9GtKJp0NImY5D3bw61bTfkGSpjWUjSzU-Sg1YcF_yzPze1z_dIxLWAqrvQ1XxwUrOaZyujmZJWL_0NsYLhPTC8gkC9a4At5tyB8cX_giY9GiMg2jeh-ryq9N-BGGsdXa8We-VWIsu8CVBtR_4ON8l9-CLQmvH3fxnEHiOkJfnVvq2qkFNO-VCs0OL5lqkFtLaKm0prv2QYMv-u8cCM59f_LX2xtwDrIobrfYJ2Cc7j7bcF9UsRERIl-H-8FM1CfK-9Ix7c3OrAX0myHDm6woOx83Tp1vQtKxjVk301TiemfmfHpnM_5ouQfFyNzA0SGbIddEsK5afK2Pgh69lIoMsGqsuvKVQk4NcGhNGHCRkYzrKaFg-LMVt3sBecO8yi_wEs8LIenVv3Nda2gL6r1WHhoBUualwSs3ahvxwy8OWDXWUCASJGgygZOFzXJAfbrwSoM3buEwIndibpeUdFgpTGXFhGwbEmJvXQ==',
    toolbarItems: [
        { type: "pager" },
        { type: "zoom-out" },
        { type: "zoom-in" },
        { type: "zoom-mode" },
        { type: "spacer" },
        { type: "text-highlighter" },
        { type: "rectangle" },
        { type: "export-pdf" },
        { type: "search" },
    ],
    annotationToolbarColorPresets: function ({ propertyName }) {
        if (propertyName === "stroke-color") {
            return {
                presets: [
                    {
                        color: new PSPDFKit.Color({ r: 255, g: 0, b: 0 }),
                        localization: {
                            id: "brightRed",
                            defaultMessage: "Bright Red",
                        },
                    },
                ],
            };
        }
    }
});
instance.setInlineTextSelectionToolbarItems(
    ({ defaultItems }) => {
        var indexToRemove = defaultItems.findIndex(defaultItems => defaultItems.type === "redact-text-highlighter");
        defaultItems.splice(indexToRemove,1);
      return defaultItems;
    }
  );
export function renderAnnotLocation(id, page_no, type, enc_annot_id = null) {
    instance.getAnnotations(page_no).then(function (results) {
        const annotations = results.toJS();
        let currentAnnotation = [];
        for (let i = 0; i < annotations.length; i++) {
            if (type == "Existing") {
                if (annotations[i]["pdfObjectId"] == id) {
                    currentAnnotation.push(annotations[i]);
                } else if (annotations[i]["id"] == enc_annot_id) {
                    currentAnnotation.push(annotations[i]);
                }
            } else {
                if (annotations[i]["id"] == id) {
                    currentAnnotation.push(annotations[i]);
                }
            }
        }
        let rectttt = currentAnnotation[0]["boundingBox"];
        let annot_id = currentAnnotation[0]["id"];
        instance.setSelectedAnnotation(annot_id);
        const rect = new PSPDFKit.Geometry.Rect({
            left: rectttt["left"],
            top: rectttt["top"],
            width: rectttt["width"],
            height: rectttt["height"],
        });
        instance.jumpToRect(page_no, rect);
    });
}

export async function savePdf(url, csrf, id, message = false) {
    const arrayBuffer = await instance.exportPDF();
    const blob = new Blob([arrayBuffer], { type: "application/pdf" });
    const formData = new FormData();
    formData.append("id", id);
    formData.append("uploadFile", blob);
    await fetch(url, {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": csrf,
        },
    })
        .then(async (response) => {
            const result = await response.json();
            if (response.ok) {
                return result;
            }
            return Promise.reject(result);
        })
        .then((responseJson) => {
            if (message) {
                return iziToast.success({
                    message: responseJson.message,
                    position: "topRight",
                });
            }
        })
        .catch((error) => {
            if (message) {
                return iziToast.error({
                    message: error.message,
                    position: "topRight",
                });
            }
        });
}
instance.addEventListener("annotations.focus", (event) => {
    var annot_id = event.annotation.pdfObjectId;
    var enc_annot_id = event.annotation.id;
    var annot_page = event.annotation.pageIndex + 1;
    var annot_page_id = "#page-tab" + annot_page;
    var find_element = '[data-id="' + annot_id + '"]';
    if ($(find_element).length > 0) {
        var search_by_id = '[data-id="' + annot_id + '"]';
    } else {
        var search_by_id = '[data-annot_id="' + enc_annot_id + '"]';
    }
    if (previous_annotation_index == "") {
        $(document).find(search_by_id).parent('div').addClass("clickedAnnotation");
    } else {
        $(document).find(previous_annotation_index).parent('div').removeClass("clickedAnnotation");
        $(document).find(search_by_id).parent('div').addClass("clickedAnnotation");
    }
    if (previous_page_index == "") {
        $(document).find(annot_page_id).addClass("show");
    } else {
        $(document).find(previous_page_index).parent('div').removeClass("show");
        $(document).find(annot_page_id).addClass("show");
    }
    previous_annotation_index = search_by_id;
    previous_page_index = annot_page_id;
});

instance.addEventListener("annotations.delete", (deletedAnnotation) => {
    var annot = deletedAnnotation.toJS();
    var xrefId = annot[0]["pdfObjectId"];
    var annotId = annot[0]["id"];
    var annotationLocation = $('div[data-id="' + xrefId + '"]').parent('div');
    if (annotationLocation.length != 0) {
        annotationLocation.remove();
    } else if (annotId.length != 0) {
        $('div[data-annot_id="' + annotId + '"]').parent('div').remove();
    }
    savePdf(savePdfUrl, csrf, pdf_id);
    // if(edited == false) {

    //     $('#currentOpenedPdf').addClass('close-document')
    //     $('#saveFomat').addClass('save-document-first')
    //     let edited_params = {
    //         "pdf_id": pdf_id
    //     };
    //     var edited_url = APP_URL + "/document/edited";
    //     var edited_response = ajaxCall(edited_url, "get", edited_params);
    // }
});
instance.addEventListener("annotations.create", async function (createdAnnotations) {
        var annot = createdAnnotations.toJS();

        var id = annot[0]["id"];
        // if(edited == false) {
        //     $('#currentOpenedPdf').addClass('close-document');
        //     $('#saveFomat').addClass('save-document-first');
        //     let edited_params = {
        //         "pdf_id": pdf_id
        //     };
        //     var edited_url = APP_URL + "/document/edited";
        //     var edited_response = ajaxCall(edited_url, "get", edited_params);
        // }
        async function createSingelAnnot(id) {
            const instantJSON = await instance.exportInstantJSON();

            const newAnnotations = instantJSON.annotations;
            let currentAnnotation = [];
            for (let i = 0; i < newAnnotations.length; i++) {
                if (newAnnotations[i]["id"] == id) {
                    currentAnnotation.push(newAnnotations[i]);
                }
            }
            if (currentAnnotation.length == 1) {
                let bbox = currentAnnotation[0].bbox;
                let page = currentAnnotation[0].pageIndex;
                let type = currentAnnotation[0].type;
                let annot_id = currentAnnotation[0].id;
                var page_id = '#page-tab'+(page + 1);
                if (type == "pspdfkit/markup/highlight") {
                    let params = {
                        bbox: bbox,
                        page: page,
                        pdf_path: pdf_path,
                        id: pdf_id,
                    };
                    var url = APP_URL + "/single/annot";
                    var response = ajaxCall(url, "get", params);
                    response
                        .then(getAnnotLocation)
                        .catch(getAnnotLocationError);
                    function getAnnotLocation(response) {
                        if (response.status) {
                            if (response.data) {
                                $("#annotationSideBar").html(response.data);
                                $(page_id).addClass('show');
                            }
                        } else {
                            console.log(response.message);
                        }
                    }
                    function getAnnotLocationError(error) {
                        console.log("error", error);
                    }
                } else if (type == "pspdfkit/shape/rectangle") {
                    var page_id = "#page-tab" + (page + 1);
                    var html =
                        "<div class='page-copy-box showAnnotation' data-type = 'new' data-page ='" +
                        page +
                        "' data-id = '" +
                        annot_id +
                        "'>"+pdf_name_to_view +"/ pg "+(page + 1)+"/Red Box <span class='text-copy text-copied'><i class='fa-solid fa-copy'></i></span></div>";
                    jQuery(page_id).find(".accordion-body").append(html);
                    jQuery(page_id).parent().removeClass("d-none");
                }
            }
        }
        await savePdf(savePdfUrl, csrf, pdf_id);
        createSingelAnnot(id);
    }
);

export async function singleAnnotCopyText(page, id, enc_annot_id) {
    const annotations = await instance.getAnnotations(page);
    const markupAnnotations = annotations.filter(
        (annotation) =>
            annotation instanceof PSPDFKit.Annotations.MarkupAnnotation
    );
    var allText = [];
    await Promise.all(
        markupAnnotations.map(async function (singleAnnotation) {
            return instance
                .getMarkupAnnotationText(singleAnnotation)
                .then(function (text) {
                    allText[singleAnnotation.id] = text;
                });
        })
    );

    var test = allText.hasOwnProperty(id);
    if (test) {
        return allText[id];
    } else {
        return allText[enc_annot_id];
    }
}
export async function renameAndDownload( filename , names ,url, csrf, id, message) {
    
    // var annotationId = names.each(function(item) {
    //     console.log(item);
    // }
    // console.log( instance.totalPageCount );
    var page_count = instance.totalPageCount;
    for(var page = 0 ; page < page_count ; page++){
        var annotations = await instance.getAnnotations(page);
        var all = annotations.toJS();
        var index ;
        // console.log(all[0]['id'],all[0].id,all.length,"dfsad");
        for(var j = 0 ; j<= all.length -1 ; j++){
            console.log(all[j]);
            var result = names.find(function ( item) {
                if(item.id == all[j].pdfObjectId){
                    return item ;
                }
            });
            if (result){

                // console.log('res',result);
                var annotation = annotations.get(j);
                //     // console.log(index,all,annotation.toJS(),'sdfsdsf');
                var updatedAnnotation = annotation.set("name", result.name);
                var updatedAnnotation = annotation.set("note", result.name);
                await instance.update(updatedAnnotation);
            }
            // console.log(result,page,annotations.get(j),result.name,result.id );
        }
        // var annotation = annotations.get(index);
        // for(var i = 0 ; i <=names.length - 1 ; i++){
        //     console.log(names[i].id,names[i].name);
        //     var annotations = await instance.getAnnotations(page);
        //     var all = annotations.toJS();
        //     var index ;
        //     // console.log(all[0]['id'],all[0].id,all.length,"dfsad");
        //     for(var j = 0 ; j<= all.length -1 ; j++){
        //         if(all[j].id == names[i].id){
        //             index = j ; 
        //         }
        //     }
        //     var annotation = annotations.get(index);
        //     // console.log(index,all,annotation.toJS(),'sdfsdsf');
        //     var updatedAnnotation = annotation.set("name", names[i].name);
        //     await instance.update(updatedAnnotation);
        //     var teee = await instance.getAnnotations(page);
        //     console.log(annotations.toJS(),annotations.get('id',names[i].id),teee.toJS(),"sdfsdsdasdasdasdasdasdasdasdasd");
          
        // }
        // console.log('page',page);
    }
    await savePdf(url, csrf, id);


    instance.exportPDF().then(blob => {
        const renamedBlob = new Blob([blob], { type: 'application/pdf' });
        const blobUrl = URL.createObjectURL(renamedBlob);
        const link = document.createElement('a');
        link.href = blobUrl;
        link.download = filename; 
        link.click();
        URL.revokeObjectURL(blobUrl);
      }).catch(error => {
        console.error(error);
      });
}