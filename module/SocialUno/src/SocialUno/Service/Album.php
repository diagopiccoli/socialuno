<?php

namespace SocialUno\Service;

use SocialUno\Service\Service;

class Album extends Service
{

	public function quantidadeAlbuns($idUser)
	{

		  $select = $this->getObjectManager()->createQueryBuilder()
                ->select('count(album)')
                ->from('SocialUno\Model\Album', 'album')
                ->where("album.usuario = ?1")
                ->setParameter(1, $idUser);

        return $select->getQuery()->getResult();  
	}

}
