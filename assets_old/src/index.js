if ("serviceWorker" in Navigator) {
    navigator.serviceWorker.register("sw.js").then(Registration =>{
        console.log("SW Registered!");
        console.log(Registration);
    }).catch(error=>{
       console.log("SW Registration failed!");
       console.log("error");
    });
}