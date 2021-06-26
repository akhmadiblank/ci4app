function previewImg(){
    const sampul=document.querySelector(".custom-file-input");
    const labelSampul=document.querySelector("#labelSampul");
    const imgSampul=document.querySelector("#img-Preview");
   
    //isi sampu label yang didapat dari inputan sampul index ke 0
    labelSampul.textContent=sampul.files[0].name;
    //ambil url penyimpanan dari files ke 0
    const fileSampul=new FileReader();
    fileSampul.readAsDataURL(sampul.files[0]);
    //rubah srcnya
    fileSampul.onload=function(e){
        imgSampul.src=e.target.result;    
    }
}



