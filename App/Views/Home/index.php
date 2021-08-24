<?php
    use App\Controllers\Form\Form;
    use App\Controllers\Form\Inputs\TextInput;
    use App\Controllers\Form\Inputs\Button;
    use App\Controllers\Form\Inputs\HiddenInput;
    use App\Controllers\Form\Inputs\SelectInput;
    use App\Controllers\Form\Inputs\NumberInput;

?>




<!-- `.container` is main centered wrapper -->
<div class="container">

    <div class="row">
        <div class="column column-100">
            <h3>Add student</h3>

            <?php
                $form = new Form( '', 'POST' );
                $form->addElement( new TextInput( 'name', 'Name', $dataStudent->name ?? '' ) );
                $form->addElement( new SelectInput( 'section', 'Section', $dataStudent->section ?? '', ['A', 'B', 'C'] ) );
                $form->addElement( new NumberInput( 'roll', 'Roll', $dataStudent->roll ?? '', range( 1, 100 ) ) );
                $form->addElement( new HiddenInput( 'id', '', $dataStudent->id ?? '' ) );

                if ( !empty( $dataStudent->id ) ) {
                    $form->addElement( new Button( 'Update' ) );
                } else {
                    $form->addElement( new Button( 'Submit' ) );
                }

                echo $form->render();
            ?>
        </div>
    </div>


    <?php
        // Show this table only if there is student info

        if ( isset( $students ) ):
    ?>
    <div class="row pt-50 pb-50">
        <div class="column column-100">
            <h3>Students List</h3>

            <table width="100%">
                <col style="width:30%">
                <col style="width:25%">
                <col style="width:25%">
                <col style="width:20%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Roll</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                        foreach ( $students as $student ):
                    ?>
                    <tr>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['section']; ?></td>
                        <td><?php echo $student['roll']; ?></td>
                        <td style="display: flex;justify-content: space-evenly;">
                            <form method="GET" style="margin-bottom: 0px">
                                <input type="hidden" name="action" value="edit">
                                <input type="hidden" name='id' value="<?php echo $student['id']; ?>">
                                <button type="submit" class="button"><i class="fas fa-edit"></i></button>
                            </form>
                            <form method="GET" style="margin-bottom: 0px">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name='id' value="<?php echo $student['id']; ?>">
                                <button type="submit" class="button"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach;?>


                </tbody>
            </table>

        </div>
    </div>
    <?php
        endif;
    ?>



</div>