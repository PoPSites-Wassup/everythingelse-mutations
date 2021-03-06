<?php

declare(strict_types=1);

namespace PoPSitesWassup\EverythingElseMutations\SchemaServices\MutationResolvers;

use PoP\ComponentModel\MutationResolvers\AbstractMutationResolver;

class UpdateUserAvatarMutationResolver extends AbstractMutationResolver
{
    public function savePicture($user_id, $delete_source = false)
    {
        // Avatar
        $gd_fileupload_userphoto = \GD_FileUpload_UserPhotoFactory::getInstance();
        $gd_fileupload_userphoto->savePicture($user_id, $delete_source);
    }

    public function execute(array $form_data): mixed
    {
        $user_id = $form_data['user_id'];
        $this->savePicture($user_id);
        $this->additionals($user_id, $form_data);

        return $user_id;
    }

    protected function additionals($user_id, $form_data)
    {
        $this->hooksAPI->doAction('gd_useravatar_update:additionals', $user_id, $form_data);
    }
}
