using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Pjtki
{
    #region Daftars
    public class Daftars
    {
        #region Member Variables
        protected unknown _id;
        protected unknown _id_daftar;
        protected unknown _id_pendaftaran;
        protected string _nik;
        protected string _nama_lengkap;
        protected string _tempat_lahir;
        protected unknown _tgl_lahir;
        protected string _status;
        protected int _tinggi;
        protected int _berat;
        protected int _id_provinsi;
        protected int _id_kota;
        protected int _id_kecamatan;
        protected unknown _id_desa;
        protected string _alamat_lengkap;
        protected string _foto_ktp;
        protected string _selfie_ktp;
        protected string _pas;
        protected unknown _telepon;
        protected unknown _terima;
        protected unknown _aktif;
        protected string _pekerjaan;
        protected string _negara;
        #endregion
        #region Constructors
        public Daftars() { }
        public Daftars(unknown id_daftar, unknown id_pendaftaran, string nik, string nama_lengkap, string tempat_lahir, unknown tgl_lahir, string status, int tinggi, int berat, int id_provinsi, int id_kota, int id_kecamatan, unknown id_desa, string alamat_lengkap, string foto_ktp, string selfie_ktp, string pas, unknown telepon, unknown terima, unknown aktif, string pekerjaan, string negara)
        {
            this._id_daftar=id_daftar;
            this._id_pendaftaran=id_pendaftaran;
            this._nik=nik;
            this._nama_lengkap=nama_lengkap;
            this._tempat_lahir=tempat_lahir;
            this._tgl_lahir=tgl_lahir;
            this._status=status;
            this._tinggi=tinggi;
            this._berat=berat;
            this._id_provinsi=id_provinsi;
            this._id_kota=id_kota;
            this._id_kecamatan=id_kecamatan;
            this._id_desa=id_desa;
            this._alamat_lengkap=alamat_lengkap;
            this._foto_ktp=foto_ktp;
            this._selfie_ktp=selfie_ktp;
            this._pas=pas;
            this._telepon=telepon;
            this._terima=terima;
            this._aktif=aktif;
            this._pekerjaan=pekerjaan;
            this._negara=negara;
        }
        #endregion
        #region Public Properties
        public virtual unknown Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual unknown Id_daftar
        {
            get {return _id_daftar;}
            set {_id_daftar=value;}
        }
        public virtual unknown Id_pendaftaran
        {
            get {return _id_pendaftaran;}
            set {_id_pendaftaran=value;}
        }
        public virtual string Nik
        {
            get {return _nik;}
            set {_nik=value;}
        }
        public virtual string Nama_lengkap
        {
            get {return _nama_lengkap;}
            set {_nama_lengkap=value;}
        }
        public virtual string Tempat_lahir
        {
            get {return _tempat_lahir;}
            set {_tempat_lahir=value;}
        }
        public virtual unknown Tgl_lahir
        {
            get {return _tgl_lahir;}
            set {_tgl_lahir=value;}
        }
        public virtual string Status
        {
            get {return _status;}
            set {_status=value;}
        }
        public virtual int Tinggi
        {
            get {return _tinggi;}
            set {_tinggi=value;}
        }
        public virtual int Berat
        {
            get {return _berat;}
            set {_berat=value;}
        }
        public virtual int Id_provinsi
        {
            get {return _id_provinsi;}
            set {_id_provinsi=value;}
        }
        public virtual int Id_kota
        {
            get {return _id_kota;}
            set {_id_kota=value;}
        }
        public virtual int Id_kecamatan
        {
            get {return _id_kecamatan;}
            set {_id_kecamatan=value;}
        }
        public virtual unknown Id_desa
        {
            get {return _id_desa;}
            set {_id_desa=value;}
        }
        public virtual string Alamat_lengkap
        {
            get {return _alamat_lengkap;}
            set {_alamat_lengkap=value;}
        }
        public virtual string Foto_ktp
        {
            get {return _foto_ktp;}
            set {_foto_ktp=value;}
        }
        public virtual string Selfie_ktp
        {
            get {return _selfie_ktp;}
            set {_selfie_ktp=value;}
        }
        public virtual string Pas
        {
            get {return _pas;}
            set {_pas=value;}
        }
        public virtual unknown Telepon
        {
            get {return _telepon;}
            set {_telepon=value;}
        }
        public virtual unknown Terima
        {
            get {return _terima;}
            set {_terima=value;}
        }
        public virtual unknown Aktif
        {
            get {return _aktif;}
            set {_aktif=value;}
        }
        public virtual string Pekerjaan
        {
            get {return _pekerjaan;}
            set {_pekerjaan=value;}
        }
        public virtual string Negara
        {
            get {return _negara;}
            set {_negara=value;}
        }
        #endregion
    }
    #endregion
}