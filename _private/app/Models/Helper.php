<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Helper
{
    public static function SearchSources ($input)
    {
        $query = Source::with('source_type')->where('is_active', 1);

        if (isset($input['query']))
            $query = $query->where( function( $query ) use($input) {
                $query->where('title', 'like', '%' . $input['query'] . '%')
                    ->orWhere('summary', 'like', '%' . $input['query'] . '%')
                    ->orWhere('text', 'like', '%' . $input['query'] . '%');
            });

        if (isset($input['types']))
            $query = $query->whereIn('source_type_id', $input['types']);

        if (isset($input['categories']))
        {
            foreach( $input['categories'] as $cat )
                $query = $query->whereExists( function ( $query ) use ( $input, $cat )
                {
                    $query->select( DB::raw( 1 ) )
                        ->from( 'category_source' )
                        ->whereRaw( 'category_source.source_id = sources.id' )
                        ->where( 'category_id', $cat );
                } );
/*
            $query = $query->whereNotExists( function ( $query ) use ( $input )
            {
                $query->select( DB::raw( 1 ) )
                    ->from( 'category_source' )
                    ->whereRaw( 'category_source.source_id = sources.id' )
                    ->whereNotIn( 'category_id', $input['categories'] );
            } );
*/
/*
            $query = $query->whereExists( function ( $query ) use ( $input )
            {
                $query->select( DB::raw( 1 ) )
                    ->from( 'category_source' )
                    ->whereRaw( 'category_source.source_id = sources.id' )
                    ->whereIn( 'category_id', $input['categories'] );
            } );
*/
        }
        if (isset($input['lang'])) {
            $query = $query->whereIn('lang', $input['lang']);
        }
        if (isset($input['tags']))
            $query = $query->whereExists(function ($query) use ($input) {
                $query->select(DB::raw(1))
                    ->from('source_tag')
                    ->whereRaw('source_tag.source_id = sources.id')
                    ->whereIn('tag_id', $input['tags']);
            });

        if (isset($input['favorites']) && $input['favorites'])
            $query = $query->whereExists(function ($query) use ($input) {
                $query->select(DB::raw(1))
                    ->from('favorite_sources')
                    ->whereRaw('favorite_sources.source_id = sources.id')
                    ->where('user_id', Auth::user()->id);
            });

        return $query;
    }

    public static function SearchLessons ($input, $lessons = false)
    {
        $lesson = ($lessons) ? $lessons : new Lesson();
        $lesson = $lesson->with('user','original_user','categories','tags');
        if (isset($input['query']))
            $lesson = $lesson->where( function( $query ) use( $input ) {
                $query->where('title', 'like', '%' . $input['query'] . '%')
                    ->orWhere('summary', 'like', '%' . $input['query'] . '%');
            }) ;

        if (isset($input['has_sound']))
            $lesson = $lesson->where('has_sound', $input['has_sound']);

        if (isset($input['has_video']))
            $lesson = $lesson->where('has_video', $input['has_video']);

        if (isset($input['requires_printouts']))
            $lesson = $lesson->where('requires_printouts', $input['requires_printouts']);

        if (isset($input['shabat_friendly']))
            $lesson = $lesson->where('shabat_friendly', $input['shabat_friendly']);

        if (isset($input['lang'])) {
            $lesson = $lesson->whereIn('lang', $input['lang']);
        }
        if (isset($input['categories']))
        {
            foreach( $input['categories'] as $cat )
                $lesson = $lesson->whereExists( function ( $query ) use ( $input, $cat )
                {
                    $query->select( DB::raw( 1 ) )
                        ->from( 'category_lesson' )
                        ->whereRaw( 'category_lesson.lesson_id = lessons.id' )
                        ->where( 'category_id', $cat );
                } );
/*
            $lesson = $lesson->whereNotExists( function ( $query ) use ( $input )
            {
                $query->select( DB::raw( 1 ) )
                    ->from( 'category_lesson' )
                    ->whereRaw( 'category_lesson.lesson_id = lessons.id' )
                    ->whereNotIn( 'category_id', $input['categories'] );
            } );
*/
        }

        if (isset($input['tags']))
            $lesson = $lesson->whereExists(function ($query) use ($input) {
                $query->select(DB::raw(1))
                    ->from('lesson_tag')
                    ->whereRaw('lesson_tag.lesson_id = lessons.id')
                    ->whereIn('tag_id', $input['tags']);
            });

        if (isset($input['age_groups']))
            $lesson = $lesson->whereExists(function ($query) use ($input) {
                $query->select(DB::raw(1))
                    ->from('age_group_lesson')
                    ->whereRaw('age_group_lesson.lesson_id = lessons.id')
                    ->whereIn('age_group_id', $input['age_groups']);
            });

        #if (isset($input['age_group']) and $input['age_group'] > 0)
        #    $lesson = $lesson->where('age_group', $input['age_group']);
//dd($lesson->get());
        return $lesson;
    }

    public static function SearchUsers($input)
    {
        $query = User::where('id','>','0');

        if (isset($input['country']) && $input['country'])
            $query = $query->where('country_id', $input['country']);

        /*
        if (isset($input['has_phone']))
            $query = $query->where('phone', '<>', '');
        */
        if (isset($input['name']) && $input['name'])
            $query = $query
                ->where(function ($query) use ($input) {
                $query->select(DB::raw(1))
                    ->from('users')
                    ->orWhere('first_name', 'like', '%' . $input['name'] . '%')
                    ->orWhere('last_name', 'like', '%' . $input['name'] . '%')
                    ->orWhereRaw('CONCAT(`first_name`," ",`last_name`) like "%' . $input['name'] . '%"');
                });
        return $query = $query->get();
    }
}
