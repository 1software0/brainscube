# Brainscube
La base para el desarrollo de la página brinscube.com.
Son los archivos necesarios para poder desarrollar con el framework [Ocrend Framework](https://github.com/prinick96/Ocrend-Framework) y con [PuPHPet](http://puphpet.com)

## Requisitos:
- Virtual Box [Get](https://www.virtualbox.org/wiki/Downloads)
- Vagrant [Get](https://vagrantup.com/downloads.html)
- Python 2.7.x [Get](https://www.python.org/downloads/release/python-2712/)

Ubuntu

```
vBoxManage --version
```
Si te pide una update del kernel

```
sudo /sbin/vboxconfig
```

## Instalación:
Hacer fork del proyecto.
En la carpeta en donde se va a inicializar el proyecto:

$ ` git clone https://github.com/tuusuario/brainscube.git `

$ ` cd tuproyecto `

Ahora a inicializar la máquina virtual:

$ ` vagrant up `

Una vez terminado verificamos que el servidor este corriendo.

Para la configuración de la base de datos:

``` shel
vagrant ssh
cd /var/www/bd
mysql -uroot -p123 < db.sql
exit
```

http://brainscube.local/
