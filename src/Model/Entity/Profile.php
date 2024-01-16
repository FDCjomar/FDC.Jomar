<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Profile Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $gender
 * @property \Cake\I18n\Date|null $birthdate
 * @property string|null $hobby
 * @property string|null $profile_image
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Profile extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'gender' => true,
        'birthdate' => true,
        'hobby' => true,
        'profile_image' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
