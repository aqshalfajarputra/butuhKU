var socket = require('socket.io');
var express = require('express');
var app = express();
var server = require('http').createServer(app);
var io = socket.listen(server);
var port = process.env.PORT || 3000;

server.listen(port, function () {
    console.log('Server listening at port %d', port);
});


io.on('connection', function (socket) {

    socket.on('new_count_message', function (data) {
        io.sockets.emit('new_count_message', {
            new_count_message: data.new_count_message

        });
    });

    socket.on('update_count_message', function (data) {
        io.sockets.emit('update_count_message', {
            update_count_message: data.update_count_message
        });
    });

    socket.on('new_message', function (data) {
        io.sockets.emit('new_message', {
            name: data.name,
            email: data.email,
            subject: data.subject,
            created_at: data.created_at,
            id: data.id
        });
    });

    socket.on('new_user', function (data) {
        io.sockets.emit('new_user', {
            id_user: data.id_user,
            name: data.name,
            username: data.username,
            password: data.password,
            role: data.role,
        });
    });

    socket.on('edited_user', function (data) {
        io.sockets.emit('edited_user', {
            id_user: data.id_user,
            name: data.name,
            username: data.username,
            password: data.password,
            role: data.role,
        });
    });

    socket.on('new_peminjaman', function (data) {
        io.sockets.emit('new_peminjaman', {
            id_user: data.id_user,
            nama_user: data.nama_user,
            waktu_peminjaman: data.waktu_peminjaman,
            waktu_pengembalian: data.waktu_pengembalian,
            penanggung: data.penanggung,
            status: data.status,
            telp_peminjam: data.telp_peminjam,
            keterangan: data.keterangan,
            barang: data.barang
        });
    });


});
