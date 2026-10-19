<?php

namespace Tests\Feature;

use App\Models\Facility;
use App\Models\FacultyMember;
use App\Models\Gallery;
use App\Models\OrganizationStructure;
use App\Models\TeachingHospital;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileCleanupTest extends TestCase
{
    use RefreshDatabase;

    public function test_deleting_faculty_member_permanently_deletes_photo_from_storage(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('faculty/dr_test.jpg', 'fake-image-bytes');
        Storage::disk('public')->assertExists('faculty/dr_test.jpg');

        $faculty = FacultyMember::create([
            'name' => 'dr. Test Sp.A',
            'position' => 'Dosen',
            'category' => 'dosen_klinis',
            'photo_url' => 'faculty/dr_test.jpg',
            'is_active' => true,
        ]);

        $faculty->delete();

        Storage::disk('public')->assertMissing('faculty/dr_test.jpg');
    }

    public function test_updating_facility_image_deletes_old_image_permanently(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('facilities/old_lab.jpg', 'old-lab-bytes');
        Storage::disk('public')->put('facilities/new_lab.jpg', 'new-lab-bytes');

        $facility = Facility::create([
            'name' => 'Laboratorium Uji',
            'slug' => 'laboratorium-uji',
            'category' => 'Laboratorium',
            'description' => 'Deskripsi lab',
            'image_url' => 'facilities/old_lab.jpg',
            'is_active' => true,
        ]);

        Storage::disk('public')->assertExists('facilities/old_lab.jpg');

        $facility->update([
            'image_url' => 'facilities/new_lab.jpg',
        ]);

        Storage::disk('public')->assertMissing('facilities/old_lab.jpg');
        Storage::disk('public')->assertExists('facilities/new_lab.jpg');
    }

    public function test_deleting_teaching_hospital_deletes_image_from_storage(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('hospitals/rs_test.jpg', 'rs-test-bytes');
        Storage::disk('public')->assertExists('hospitals/rs_test.jpg');

        $hospital = TeachingHospital::create([
            'name' => 'RS Test Lombok',
            'slug' => 'rs-test-lombok',
            'type' => 'utama',
            'image_url' => 'hospitals/rs_test.jpg',
            'is_active' => true,
        ]);

        $hospital->delete();

        Storage::disk('public')->assertMissing('hospitals/rs_test.jpg');
    }

    public function test_deleting_gallery_item_deletes_image_from_storage(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('galleries/photo_test.jpg', 'photo-bytes');
        Storage::disk('public')->assertExists('galleries/photo_test.jpg');

        $gallery = Gallery::create([
            'title' => 'Foto Dokumentasi Kegiatan',
            'category' => 'Praktikum & Klinis',
            'image_url' => 'galleries/photo_test.jpg',
            'is_active' => true,
        ]);

        $gallery->delete();

        Storage::disk('public')->assertMissing('galleries/photo_test.jpg');
    }

    public function test_static_images_in_public_images_are_never_deleted(): void
    {
        Storage::fake('public');

        $faculty = FacultyMember::create([
            'name' => 'dr. Pimpinan Static',
            'position' => 'Pimpinan',
            'category' => 'pimpinan',
            'photo_url' => '/images/pimpinan/wd2.jpeg',
            'is_active' => true,
        ]);

        $faculty->delete();

        $this->assertFileExists(public_path('images/pimpinan/wd2.jpeg'));
    }

    public function test_shared_file_is_not_deleted_if_still_referenced_by_another_record(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('facilities/shared_lab.jpg', 'shared-bytes');

        $facility1 = Facility::create([
            'name' => 'Lab Satu',
            'slug' => 'lab-satu',
            'category' => 'Laboratorium',
            'description' => 'Deskripsi 1',
            'image_url' => 'facilities/shared_lab.jpg',
            'is_active' => true,
        ]);

        $facility2 = Facility::create([
            'name' => 'Lab Dua',
            'slug' => 'lab-dua',
            'category' => 'Laboratorium',
            'description' => 'Deskripsi 2',
            'image_url' => 'facilities/shared_lab.jpg',
            'is_active' => true,
        ]);

        $facility1->delete();

        // Still exists because $facility2 references it
        Storage::disk('public')->assertExists('facilities/shared_lab.jpg');

        $facility2->delete();

        // Now both are deleted, so the file is deleted
        Storage::disk('public')->assertMissing('facilities/shared_lab.jpg');
    }

    public function test_deleting_organization_structure_deletes_image_from_storage(): void
    {
        Storage::fake('public');

        Storage::disk('public')->put('organization/sotk_test.png', 'fake-sotk-image-bytes');
        Storage::disk('public')->assertExists('organization/sotk_test.png');

        $structure = OrganizationStructure::create([
            'title' => 'Bagan SOTK',
            'image_url' => 'organization/sotk_test.png',
            'is_active' => true,
        ]);

        $structure->delete();

        Storage::disk('public')->assertMissing('organization/sotk_test.png');
    }
}
