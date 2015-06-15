<?php

namespace SocialUno\Service;

use SocialUno\Service\Service;
use SocialUno\Model\Publicacao as PublicacaoModel;
use SocialUno\Model\Fotos as FotosModel;
use SocialUno\Model\Album as AlbumModel;
use SocialUno\Model\Curtidas as CurtidasModel;

class Publicacao extends Service
{
		public function adicionarPublicacao($post, $files, $idUser)
		{

			$tipo_publicacao = $this->getObjectManager()->find('SocialUno\Model\TipoPublicacao', (int)$post['permissao']);
			$usuario = $this->getObjectManager()->find('SocialUno\Model\Usuario', (int)$idUser);
			$quantidadeFiles = count($files['name']);

			for($i=0;$i<$quantidadeFiles;$i++){

				if($files['name'][$i] != ''){

					$extencao = explode('.',  $files['name'][$i])[1];
					$arrayImg = ['jpg', 'jpeg', 'png', 'gif'];

					if(in_array($extencao, $arrayImg)) {

						$uploadfile = 'fotos_usuarios/';
				//		/public/img/fotos_usuarios/ n consegui
					
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

				$this->getObjectManager()->flush();
			}

			if(!isset($arrayImg)){
				$publicacao = new PublicacaoModel();

				if(isset($post))
					$publicacao->setPublicacao(utf8_decode($post['text-area-publicacao']));

				$publicacao->setTipoPublicacao($tipo_publicacao);
				$publicacao->setUsuario($usuario);
				$publicacao->setDataPublicacao(new \DateTime('now'));
				$this->getObjectManager()->persist($publicacao);
			}

			try {
	            $this->getObjectManager()->flush();
	            return true;
	        } catch (Exception $exc) {
	            return false;
	        }

		}


		public function buscaPublicacoesUsuario($idUser,$amizade)
		{
			$sql = 'AND tipo.id = 3';
			if($amizade['id_status'] == 1){
				$sql = ' AND tipo.id <> 1';
			}

			$select = $this->getObjectManager()->createQueryBuilder()
	                ->select('pub.id, pub.publicacao, tipo.desc_publicacao')
	                ->from('SocialUno\Model\Publicacao', 'pub')
	                ->join('pub.tipo_publicacao', 'tipo')
	                ->where("pub.usuario = ?1 $sql")
	                ->setParameter(1, $idUser)
	                ->orderBy('pub.data_publicacao', 'DESC');

	        return $select->getQuery()->getArrayResult();  
		}


		public function buscaPublicacoesAmigos($ids_amigos)
		{
			$select = $this->getObjectManager()->createQueryBuilder()
	                ->select('pub', 'tipo','usuario')
	                ->from('SocialUno\Model\Publicacao', 'pub')
	                ->join('pub.tipo_publicacao', 'tipo')
	                ->join('pub.usuario', 'usuario')
	                ->where("pub.usuario in ($ids_amigos) and pub.tipo_publicacao <> 1")
	                ->orderBy('pub.data_publicacao', 'DESC');

	        return $select->getQuery()->getArrayResult();

		}

		public function curtirPublicacao($id, $idUser, $tipo)
		{
			$curtir = new CurtidasModel();

			$usuario = $this->getObjectManager()->find('SocialUno\Model\Usuario', (int)$idUser);
			$publicacao = $this->getObjectManager()->find('SocialUno\Model\Publicacao', (int)$id);

			$curtir->setUsuario($usuario);
			$curtir->setPublicacao($publicacao);
			$curtir->setTipo($tipo);

			$this->getObjectManager()->persist($curtir);

			try {
	            $this->getObjectManager()->flush();
	            return true;
	        } catch (Exception $exc) {
	            return false;
	        }

		}

		public function descurtirPublicacao($id, $idUser)
		{
			$curtir = $this->getObjectManager()->getRepository('SocialUno\Model\Curtidas')->findOneBy(array('usuario' => $idUser, 'publicacao' => $id));
	        $this->getObjectManager()->remove($curtir);
	        try {
	            $this->getObjectManager()->flush();
	            return true;
	        } catch (\Exception $ex) {
	            return false;
	        }
		}

		public function buscaCurtidas($id_publicacao, $idUser, $tipo)
		{

			//var_dump($id_publicacao, $idUser , $tipo); exit;
			$select = $this->getObjectManager()->createQueryBuilder()
	                ->select('curtidas')
	                ->from('SocialUno\Model\Curtidas', 'curtidas')
	                ->where("curtidas.publicacao = $id_publicacao and curtidas.tipo = '$tipo'");

	        $resultCurtidas = $select->getQuery()->getArrayResult();

	         $select = $this->getObjectManager()->createQueryBuilder()
	                ->select('usu.id')
	                ->from('SocialUno\Model\Curtidas', 'curtidas')
	                ->join('curtidas.usuario', 'usu')
	                ->where("curtidas.publicacao = $id_publicacao and curtidas.tipo = '$tipo' and curtidas.usuario = $idUser");

	        $resultUserCurtir = $select->getQuery()->getArrayResult() ? $select->getQuery()->getArrayResult()[0]['id'] : '';

	        return [
	        	'quantidade' => count($resultCurtidas),
	        	'usuario' => $resultUserCurtir
	        ];
		}

}
