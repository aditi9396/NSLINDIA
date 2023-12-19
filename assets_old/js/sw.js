self.addEventListener("install",e=>{
    e.waituntil(
        caches.open("static").then(caches=>{
            return cache.addall(["./",".assets_old/src/master.css", ".assets_old/images/logo192.png"]);
        })
    );
});

self.addEventListener("fetch", e=>{
    e.respondwith(e.request).then(response=>{
        return response || fetch(e.request);
    })
})