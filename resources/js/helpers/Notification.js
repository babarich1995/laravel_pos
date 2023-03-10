class Notification {

    success(){
        new Noty({
        type:'success',
        layout:'topRight',
        text:'Successfully done!',
        timeout:1000
        }).show();
    }
    error(){
        new Noty({
        type:'alert',
        layout:'topRight',
        text:'Something went Wrong',
        timeout:1000
        }).show();
    }
    alert(){
        new Noty({
        type:'alert',
        layout:'topRight',
        text:'Are you Sure?',
        timeout:1000
        }).show();
    }
    warning(){
        new Noty({
        type:'warning',
        layout:'topRight',
        text:'Opss wrong',
        timeout:1000
        }).show();
    }

    image_validation(){
        new Noty({
        type:'error',
        layout:'topRight',
        text:'Upload image less than 1MB',
        timeout:2000
        }).show();
    }
    cart_success(){
        new Noty({
        type:'success',
        layout:'topRight',
        text:'Added to cart Successfully!',
        timeout:1000
        }).show();
    }
    cart_delete(){
        new Noty({
        type:'error',
        layout:'topRight',
        text:'Removed from cart Successfully!',
        timeout:1000
        }).show();
    }
}

export default Notification = new Notification()