<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\S_Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DepartmentsTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(Course_ListsTableSeeder::class);
        $this->call(Y_SubjectsTableSeeder::class);
        $this->call(TimeTableTableSeeder::class);
        $this->call(C_SubjectTableSeeder::class);
        $this->call(S_CommentsTableSeeder::class);
        $this->call(T_CommentsTableSeeder::class);
        $this->call(SubjectFavoritesTableSeeder::class);
        $this->call(Y_Subjects_FavoritesTableSeeder::class);
    }
}
