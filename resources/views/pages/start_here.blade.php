@extends('layouts.app')
@section('title') Start Here :: @parent @stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2 class="center_form">How to use Materials Share</h2>
            </div>
        </div>


        @include('partials.start_nav')


        <div class="col-md-9">
           <h3>Index</h3>
            <ul>

                <li>
                    <h3><a href="#menubar">Menu bar</a></h3>

                </li>
                <li>
                    <h3><a href="#materials">Materials</a></h3>
                </li>
                <li>
                    <h3><a href="#viewmaterial">View a Material</a></h3>
                </li>
                <li>
                    <h3><a href="#search">Search</a></h3>
                </li>
                <li>
                    <h3><a href="#filter">Filter</a></h3>
                </li>
                <li>
                    <h3><a href="#register">Register</a></h3>
                </li>
                <li>
                    <h3><a href="#login">Login/Logout</a></h3>
                </li>
                <li>
                    <h3><a href="#privatepublic">Private Public Materials</a></h3>
                </li>
                <li>
                    <h3><a href="#ratematerial">Rate Material</a></h3>
                </li>
                <li>
                    <h3><a href="#savematerial">Save Material</a></h3>
                </li>
                <li>
                    <h3><a href="#downloadmaterial">Download Material</a></h3>
                </li>
                <li>
                    <h3><a href="#mymaterials">My Materials</a></h3>
                </li>
                <li>
                    <h3><a href="#creatematerial">Create Material</a></h3>
                </li>
                <li>
                    <h3><a href="#editmaterial">Edit Material</a></h3>
                </li>
                <li>
                    <h3><a href="#printmaterial">Print Material</a></h3>
                </li>
            </ul>

            <hr>
           <h3>
               <a class="start_padding" name="menubar">Menu bar</a>

            </h3>

            <p>The menu bar is located at the top of the screen. It looks different on mobile and is not visible to
                begin with. On mobile you have to hit the icon in the top right hand corner with three bars on it to
                open the menu. See the pictures for both desktop and mobile menu bars.</p>

            
            <p>The menu is like a navigation panel. It allows you to see different areas of Materials Share. You are
                now in the Start Here area. Have a look at the other areas you can visit. We will take a look at
                each in more detail further down the page.</p>

            <p>Click or tap on any menu item to go to that page.</p>

            <hr>

           <h3>
               <a class="start_padding" name="materials">Materials</a>
            </h3>

            <p>The materials page is where you view all materials created and currently shared</p>

            <p>The materials page gives you brief information about each material, such as: title, objective, level, the
                textbook it can be used with and a picture of files associated with the material. You can click on any
                material to get
                the full details. </p>

            <hr>
           <h3>
               <a class="start_padding" name="viewmaterial">View a Material</a>
            </h3>

            <p>By clicking Materials button on the menu bar you will get a list of all the materials currently available
                on the site. If you want more detail on a particular material click on its title. This will bring you
                into the material's page. From here you have many options.</p>

            <p>If you are not logged in you can browse the material.</p>

            <p>If you are logged in:</p>

            <p>If you own the material you can edit or delete the material by clicking the appropriate button. You can
                also make the material public or
                private. </p>

            <p>If you are not the owner of the material you can save the material in your My Materials page by
                clicking the save button. You can download the files the accompany the material. You can also rate and
                leave comments about the material.</p>

            <hr>
           <h3>
               <a class="start_padding" name="search">Search</a>
            </h3>

            <p>As the collection of materials increases it will become more difficult to just browse to files you are
                interested in. A search function has been implemented on the site to aid in finding a material specifc
                to you needs. Just key in a word such as "family" and Materials Share will search it's database for
                materials containing the key word. </p>

            <p>Search is located on the menu bar. Just type a relevant word and hit enter. All the materials pertinent
                to the search query will be displayed.</p>

            <hr>
           <h3>
               <a class="start_padding" name="filter">Filter</a>
            </h3>

            <p>Filer is similar to search in that it reduces the number of materials into something more meaningful.
                However, filter reduces by a number of factors at once. Say you want a material for "Level 2", which
                lasts "10" minutes and involves "speaking", then you can set these filters and only find materials with
                these attributes.</p>

            <p>The filter button is located at the top on the materials page. Click it to see the filter criteria.
                Choose your criteria and hit the "start filter" button to see your selection.</p>

            <hr>
           <h3>
               <a class="start_padding" name="register">Register</a>
            </h3>

            <p>Registering is free and gives you many benefits. Registered users can: upload, edit and download
                materials; save new materials to their "My materials" page and rate and comment on materials </p>

            <p>Registering is easy. Click on Register on the menu bar. You will back teken to a form. Fill out all the
                details requested. Please use a strong password one with numbers letters and characters longer than 8
                characters is a good password. Click the submit button. You should see a new page asking you to check
                the email address you have registered with. Please check for an email from Materials Share. The email
                should contain a link. Click on this link to activate your account. You should now see your "my
                Materials" page. You are now logged in.</p>

            <hr>
           <h3>
               <a class="start_padding" name="login">Login/Logout</a>
            </h3>

            <p>To login or logout simply click on the appropriate button in the menu bar. Login will require that you
                are registered and the email address and password you chose when you registered. When you login you will
                be taken to your "My Materials" page.</p>

            <hr>
           <h3>
               <a class="start_padding" name="privatepublic">Private / Public Materials</a>
            </h3>

            <p>All materials can be made public or private. Materials public or private status can only be changed by
                their creator/owner. Making a material public means it can be viewed, searched for, filtered to and/or
                saved in the "Materials" page. If the material is made private only you, the creator of the material can
                see it in your "My materials" page. You may wish to make materials that are not complete yet
                private.</p>

            <hr>
           <h3>
               <a class="start_padding" name="ratematerial">Rate Material</a>
            </h3>

            <p>If you are logged in you are able to give a rating of 0-5 (including half) hearts. To do so go the the
                detailed view of the material you want to rate (find material and click on its title). From here you can
                select as many hearts as you want for the material and then hit the "rate" button to register your
                opinion. You can change your mind and re-rate by using the same method at anytime but, you can only vote
                once. After your vote the hearts display the average value of the votes, not your vote.</p>

            <hr>
           <h3>
               <a class="start_padding" name="savematerial">Save Material</a>
            </h3>

            <P>Materials can be saved to your "My Materials" page from the "Materials" page or from the detailed view of
                a material. If you are logged in simply click the "Save to my materials" button to save or "Remove from
                my materials" to remove. Once a material is saved you can easily find it again in your "My Materials"
                page. </P>

            <hr>
           <h3>
               <a class="start_padding" name="downloadmaterial">Download Material</a>
            </h3>

            <P>If you are logged in you may download materials. To do this go to the detailed view of a material (click
                on the title from "My Materials" or "Materials" pages). In the detailed view you will see a download
                button under the image of the attached files. Click this button to start the download. Please note this
                may take a while depending on your internet connection speed and the size of the file. Also not files
                downloaded are at original file size not reduced as you see on the preview.</P>

            <hr>
           <h3>
               <a class="start_padding" name="mymaterials">My Materials</a>
            </h3>

            <p>My Materials is your home page. It is where all the materials you have created are stored. It can only be
                accessed by you the owner when you are logged in. Materials that are private can be worked on from here.
                Materials can be made public (or private) from here too. All your saved materials will also be here.</p>

            <hr>

           <h3>
               <a class="start_padding" name="creatematerial">Create Material</a>
            </h3>

            <p>To create a material you must be logged in. Creating a material is a two stage process. The first stage
                is
                to chose the attributes your material requires. The second stage is to provide details about those
                attributes. Please note you can edit a material and add attributes to it or update it at anytime</p>

            <p>Stage one: choosing attributes- To create a new materials hit the "New Material" button. A new screen
                will lead with a number of buttons. Each button represents a different attribute of your
                material. You may choose as many or a few attributes as you require. There is a "?" which will give you
                more information on each attribute if you require. Hover over the "?" (or tap on mobile) for extra
                information.</p>

            <p>Perhaps if you are in a rush you may jut choose "files". You could take a quick picture with your phone
                and give the material a title and you
                would be done. Later you could edit the material and fill out more details. Or, as a conscientious
                uploader you may chose to complete all the fields in one sitting. </p>

            <p>Stage two: complete the form - for each button you selected in stage one, one of a number of different
                input type tools will be displayed. Please try to complete these as best you can. You can always edit
                them later if you make mistakes. Once all the fields are complete press the continue button. If there
                are
                no errors in the form you will be taken to the "My Materials" page where you should see your recently
                created material.</p>

            <hr>
           <h3>
               <a class="start_padding" name="editmaterial">Edit Material</a>
            </h3>

            <p>To edit a material you will need to be logged in. You will need to be in the detailed view of the
                material. You need to be the creator of the material. Click the "Edit" button to edit. This will take
                you to a menu similar to when you created the material. </p>

            <p>There are two columns (one on mobile) The first column shows the current attributes of the material. To
                edit them click on the button to select the
                attribute to edit. The right hand column (below on mobile) represents available attributed you may want
                to add to your material. Click any attributes you wish to add. Note if you click again on the attribute
                it will deselect. </p>

            <p>When you have chosen all the attributes you want to add or edit click the "continue"
                button at the bottom of the screen. This will take you to the form for making you edits. Once you have
                completed the form click continue to finish. You will be taken back to your "My Materials" page where
                you will see the edited material.</p>
            <hr>

           <h3>
               <a class="start_padding" name="printmaterial">Print Material</a>
            </h3>

            <p>If you wish to print any material you can press the "CTRL" + "p" on your keyboard. This will open the
                print service of your browser where you will see a modified version of the material designed for
                print. Follow the instructions for printing. Please note with attached files it is highly recommended to
                download these files and then print off. Low quality images are used for fast load times on the
                website. </p>

            <hr>
        </div>
    </div>
@endsection