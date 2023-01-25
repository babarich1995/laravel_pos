class AppStorage{

    storeToken(token){
        localStorage.setItem('token',token)
    }
    storeUser(user){
        localStorage.setItem('user',user)
    }

    store(token,user){
     this.storeToken(token);
     this.storeUser(user);
    }

    clear(){
        this.localStorage.removeItem('token');
        this.localStorage.removeItem('user');
    }

    getToken(){
        this.localStorage.getItem(token)
    }
    getUser(){
        this.localStorage.getItem(user)
    }
}

export default AppStorage = new AppStorage();