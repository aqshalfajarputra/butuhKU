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
            role: data.role
        });
    });

    socket.on('edited_status', function (data) {
        io.sockets.emit('edited_status', {
            id_peminjaman: data.id_peminjaman,
            status_peminjaman: data.status_peminjaman
        });
    });

    socket.on('new_peminjaman', function (data) {
        io.sockets.emit('new_peminjaman', {
            id_user: data.id_user,
            nama_user: data.nama_user,
            waktu_peminjaman: data.waktu_peminjaman,
            waktu_pengembalian: data.waktu_pengembalian,
            penanggung: data.penanggung,
            status_peminjaman: data.status_peminjaman,
            telp_peminjam: data.telp_peminjam,
            keterangan: data.keterangan,
            barang: data.barang
        });
    });

    socket.on('new_laporan', function (data) {
        io.sockets.emit('new_laporan', {
            id_user: data.id_user,
            judul_laporan: data.judul_laporan,
            foto_laporan: data.foto_laporan,
            waktu_laporan: data.waktu_laporan,
            status_laporan: data.status_laporan,
            deskripsi: data.deskripsi
        });
    });

    socket.on('count_notif', function (data) {
        io.sockets.emit('count_notif', {
            count_notif: data.count_notif
        });
    });


    socket.on('add_barang', function (data) {
        io.sockets.emit('add_barang', {
            id_barang: data.id_barang,
            nama_barang: data.nama_barang,
            stok_barang: data.stok_barang,
            id_kategori: data.id_kategori,
            foto_barang: data.foto_barang
        });
    });



});
