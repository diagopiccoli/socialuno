<?php

namespace SocialUno\Service;

use SocialUno\Service\Service;
use SocialUno\Model\Publicacao as PublicacaoModel;
use SocialUno\Model\Fotos as FotosModel;
use SocialUno\Model\Album as AlbumModel;

class Publicacao extends Service
{
		public function adicionarPublicacao($post, $files, $idUser)
		{

			$tipo_publicacao = $this->getObjectManager()->find('SocialUno\Model\TipoPublicacao', (int)$post['permissao']);
			$usuario =  $this->getObjectManager()->find('SocialUno\Model\Usuario', (int)$idUser);
			$quantidadeFiles = count($files['name']);

			for($i=0;$i<$quantidadeFiles;$i++){

				if($files['name'][$i] != ''){

					$extencao = explode('.',  $files['name'][$i])[1];
					$arrayImg = ['jpg', 'jpeg', 'png', 'gif'];

					if(in_array($extencao, $arrayImg)) {

						$uploadfile = 'fotos_usuarios/';
				//		/public/img/fotos_usuarios/
					
						if (!move_uploaded_file($files['tmp_name'][$i], $uploadfile.basename($files['name'][$i]))) {
								return false;
						}

						$fotos = new FotosModel();
						$tipo_album = $this->getObjectManager()->find('SocialUno\Model\TipoAlbum', 1);
						$album = $this->getObjectManager()->getRepository('\SocialUno\Model\Album')->findOneBy(['usuario' => $idUser]);

						if(!$album){
							$album = new AlbumModel();
							$album->setTipoAlbum($tipo_album);
							$album->setUsuario($usuario);
							$album->setDataCriacao(new \DateTime('now'));
							$this->getObjectManager()->persist($album);
						}

						$fotos->setAlbum($album);
						$fotos->setCaminho($uploadfile.basename($files['name'][$i]));
						$fotos->setDataPublicacao(new \DateTime('now'));
						if(isset($post))
							$fotos->setDescFoto(utf8_decode($post['text-area-publicacao']));
						$this->getObjectManager()->persist($fotos);
					}
				}
			}

			if(!isset($arrayImg)){
				$publicacao = new PublicacaoModel();

				if(isset($post))
					$publicacao->setPublicacao(utf8_decode($post['text-area-publicacao']));

				$publicacao->setTipoPublicacao($tipo_publicacao);
				$publicacao->setUsuario($usuario);
				$publicacao = $this->getObjectManager()->persist($publicacao);
			}

			try {
	            $this->getObjectManager()->flush();
	            return true;
	        } catch (Exception $exc) {
	            echo $ecx;
	        }

		}

}
