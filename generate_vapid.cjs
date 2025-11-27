const webpush = require("web-push");

const vapid = webpush.generateVAPIDKeys();
console.log("PUBLIC:", vapid.publicKey);
console.log("PRIVATE:", vapid.privateKey);
