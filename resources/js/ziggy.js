const Ziggy = {"url":"http:\/\/laradminvuetify.test","port":null,"defaults":{},"routes":{"login":{"uri":"login","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]},"password.request":{"uri":"forgot-password","methods":["GET","HEAD"]},"password.reset":{"uri":"reset-password\/{token}","methods":["GET","HEAD"]},"password.email":{"uri":"forgot-password","methods":["POST"]},"password.update":{"uri":"reset-password","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"verification.notice":{"uri":"email\/verify","methods":["GET","HEAD"]},"verification.verify":{"uri":"email\/verify\/{id}\/{hash}","methods":["GET","HEAD"]},"verification.send":{"uri":"email\/verification-notification","methods":["POST"]},"password.confirmation":{"uri":"user\/confirmed-password-status","methods":["GET","HEAD"]},"password.confirm":{"uri":"user\/confirm-password","methods":["POST"]},"welcome":{"uri":"\/","methods":["GET","HEAD"]},"dashboard.index":{"uri":"dashboard","methods":["GET","HEAD"]},"basicdata.index":{"uri":"app\/intial-data","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
