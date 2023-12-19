self.addEventListener("install",e=>{
    e.waituntil(
        caches.open("static").then(caches=>{
            return cache.addall(["./","./src/master.css", "./images/logo192.png"]);
        })
    );
});

self.addEventListener("fetch", e=>{
    e.respondwith(e.request).then(response=>{
        return response || fetch(e.request);
    })
})