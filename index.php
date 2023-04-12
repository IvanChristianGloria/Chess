<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chess</title>
</head>
<style>
    *
    {
        box-sizing: border-box;
    }
    html, body
    {
        margin:0;
    }
    .chess-board
    {
        height:500px;
        width:500px;
        position:relative;
    }
    .chess-pattern
    {
        height:100%;
        width:100%;
        display:grid;
        grid-template-columns: repeat(8, 12.5%);
        grid-template-rows: repeat(8, 12.5%);
    }
    .cp-w
    {
        background-color:#eeeed5;
    }
    .cp-b
    {
        background-color:#7d945d;
    }
    .cp-w img, .cp-b img
    {
        height:100%;
        width:100%;
    }
    .prev-move
    {
        box-shadow:inset 0px 0px 20px 5px yellow;
        transition:0.1s;
    }
    .possible-move
    {
        box-shadow:inset 0px 0px 20px 5px #595fff;
        transition:0.1s;
    }
    .attack
    {
        box-shadow:inset 0px 0px 20px 5px red;
        transition:0.1s;
    }
    .cp
    {
        position:relative;
    }
    .promotion-options
    {
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:400%;
        display:grid;
        grid-template-rows: repeat(4, 25%);
        grid-template-columns: 100%;
        z-index:1;
        box-shadow:0px 0px 10px black;
    }
    .promotion-options.below
    {
        top:auto;
        bottom:0;
    }
    .promote-to
    {
        display:flex;
        justify-content: center;
        align-items: center;
        background-color:white;
        transition:0.1s;
    }
    .promote-to:hover
    {
        box-shadow:inset 0px 0px 20px 5px #595fff;
    }
</style>
<body>
    <div class='chess-board'>
        <div class='chess-pattern'>
            <div class='cp-w 1-8 cp' data-col='8' data-row='1'></div>
            <div class='cp-b 2-8 cp' data-col='8' data-row='2'></div>
            <div class='cp-w 3-8 cp' data-col='8' data-row='3'></div>
            <div class='cp-b 4-8 cp' data-col='8' data-row='4'></div>
            <div class='cp-w 5-8 cp' data-col='8' data-row='5'></div>
            <div class='cp-b 6-8 cp' data-col='8' data-row='6'></div>
            <div class='cp-w 7-8 cp' data-col='8' data-row='7'></div>
            <div class='cp-b 8-8 cp' data-col='8' data-row='8'></div>
            <div class='cp-b 1-7 cp' data-col='7' data-row='1'></div>
            <div class='cp-w 2-7 cp' data-col='7' data-row='2'></div>
            <div class='cp-b 3-7 cp' data-col='7' data-row='3'></div>
            <div class='cp-w 4-7 cp' data-col='7' data-row='4'></div>
            <div class='cp-b 5-7 cp' data-col='7' data-row='5'></div>
            <div class='cp-w 6-7 cp' data-col='7' data-row='6'></div>
            <div class='cp-b 7-7 cp' data-col='7' data-row='7'></div>
            <div class='cp-w 8-7 cp' data-col='7' data-row='8'></div>
            <div class='cp-w 1-6 cp' data-col='6' data-row='1'></div>
            <div class='cp-b 2-6 cp' data-col='6' data-row='2'></div>
            <div class='cp-w 3-6 cp' data-col='6' data-row='3'></div>
            <div class='cp-b 4-6 cp' data-col='6' data-row='4'></div>
            <div class='cp-w 5-6 cp' data-col='6' data-row='5'></div>
            <div class='cp-b 6-6 cp' data-col='6' data-row='6'></div>
            <div class='cp-w 7-6 cp' data-col='6' data-row='7'></div>
            <div class='cp-b 8-6 cp' data-col='6' data-row='8'></div>
            <div class='cp-b 1-5 cp' data-col='5' data-row='1'></div>
            <div class='cp-w 2-5 cp' data-col='5' data-row='2'></div>
            <div class='cp-b 3-5 cp' data-col='5' data-row='3'></div>
            <div class='cp-w 4-5 cp' data-col='5' data-row='4'></div>
            <div class='cp-b 5-5 cp' data-col='5' data-row='5'></div>
            <div class='cp-w 6-5 cp' data-col='5' data-row='6'></div>
            <div class='cp-b 7-5 cp' data-col='5' data-row='7'></div>
            <div class='cp-w 8-5 cp' data-col='5' data-row='8'></div>
            <div class='cp-w 1-4 cp' data-col='4' data-row='1'></div>
            <div class='cp-b 2-4 cp' data-col='4' data-row='2'></div>
            <div class='cp-w 3-4 cp' data-col='4' data-row='3'></div>
            <div class='cp-b 4-4 cp' data-col='4' data-row='4'></div>
            <div class='cp-w 5-4 cp' data-col='4' data-row='5'></div>
            <div class='cp-b 6-4 cp' data-col='4' data-row='6'></div>
            <div class='cp-w 7-4 cp' data-col='4' data-row='7'></div>
            <div class='cp-b 8-4 cp' data-col='4' data-row='8'></div>
            <div class='cp-b 1-3 cp' data-col='3' data-row='1'></div>
            <div class='cp-w 2-3 cp' data-col='3' data-row='2'></div>
            <div class='cp-b 3-3 cp' data-col='3' data-row='3'></div>
            <div class='cp-w 4-3 cp' data-col='3' data-row='4'></div>
            <div class='cp-b 5-3 cp' data-col='3' data-row='5'></div>
            <div class='cp-w 6-3 cp' data-col='3' data-row='6'></div>
            <div class='cp-b 7-3 cp' data-col='3' data-row='7'></div>
            <div class='cp-w 8-3 cp' data-col='3' data-row='8'></div>
            <div class='cp-w 1-2 cp' data-col='2' data-row='1'></div>
            <div class='cp-b 2-2 cp' data-col='2' data-row='2'></div>
            <div class='cp-w 3-2 cp' data-col='2' data-row='3'></div>
            <div class='cp-b 4-2 cp' data-col='2' data-row='4'></div>
            <div class='cp-w 5-2 cp' data-col='2' data-row='5'></div>
            <div class='cp-b 6-2 cp' data-col='2' data-row='6'></div>
            <div class='cp-w 7-2 cp' data-col='2' data-row='7'></div>
            <div class='cp-b 8-2 cp' data-col='2' data-row='8'></div>
            <div class='cp-b 1-1 cp' data-col='1' data-row='1'></div>
            <div class='cp-w 2-1 cp' data-col='1' data-row='2'></div>
            <div class='cp-b 3-1 cp' data-col='1' data-row='3'></div>
            <div class='cp-w 4-1 cp' data-col='1' data-row='4'></div>
            <div class='cp-b 5-1 cp' data-col='1' data-row='5'></div>
            <div class='cp-w 6-1 cp' data-col='1' data-row='6'></div>
            <div class='cp-b 7-1 cp' data-col='1' data-row='7'></div>
            <div class='cp-w 8-1 cp' data-col='1' data-row='8'></div>
        </div>
    </div>
    <button class='play' data-id='0'>Play as white</button>
    <button class='play' data-id='1'>Play as black</button>
</body>
<script
  src="https://code.jquery.com/jquery-3.6.4.slim.min.js"
  integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw="
  crossorigin="anonymous"></script>
<script>
    const board_template = ['','rook', 'knight', 'bishop', 'queen', 'king', 'bishop', 'knight', 'rook']
    const color_template = [['w', 'b'], ['b', 'w']]
    const rows_template = [2, 7]
    const rows_main_template = [[2, 0], [8, 6]]
    const enemy = ['b', 'w']
    const your_color = ['w', 'b']
    const pawn_promotion_square = [8, 1]
    let is_ep_curr = false
    let on_promotion = false
    let selected_promotion_square
    let turn = 0
    let play_as = 0
    let sel_piece
    let under_attack = []
    let ua_rowcol = []
    let rowcol_king_threats = []
    let piece_protected = []

    //MAIN FUNCTIONS__________________________________________________________________________
    
    //SET PIECE ON BOARD
    const set_piece = (e, c, p) => {
        return `<img src='piece/${e}.png' class='p-${c}' data-id='${p}'>`
    }

    //RESET BOARD
    const reset_board = (e) => {
        $('img').remove()
        clear_moves()
        $('.prev-move').removeClass('prev-move')
        const color = color_template[e]
        
        for(let count = 0 ; count < 2 ; count ++ )
        {
            for(let row = rows_main_template[count][0] ; row > rows_main_template[count][1] ; row -- )
            {
                for(let col = 8 ; col > 0 ; col -- )
                {
                    const el = $(`.${col}-${row}`)
                    const c = color[count]
                    const piece = board_template[col]
                    if(row == rows_template[count])
                        el.html(set_piece(`${c}-pawn`, c, 'pawn'))
                    else
                        el.html(set_piece(`${c}-${piece}`, c, piece))
                }
            }
        }
    }
    
    //MARK A POSSIBLE MOVE
    const show_move = (row, col) => {
        $(`.${row}-${col}`).addClass('possible-move')
    }

    //MARK A POSSIBLE ATTACK
    const show_attack = (row, col) => {
        $(`.${row}-${col}`).addClass('attack')
    }

    //PIECE MOVEMENT ALLOCATION
    const move_piece = (e) => {
        const piece_name = e.data('id')
        const parent = e.parent()
        sel_piece = parent

        const is_ck = is_checked()

        if(is_checked())
        if(piece_name == 'pawn')
            pawn(e.attr('class'), parent.data('row'), parent.data('col'))
        if(piece_name == 'knight')
            knight(parent.data('row'), parent.data('col'))
        if(piece_name == 'bishop')
            bishop(parent.data('row'), parent.data('col'))
        if(piece_name == 'rook')
            rook(parent.data('row'), parent.data('col'))
        if(piece_name == 'king')
            king(parent.data('row'), parent.data('col'))
        if(piece_name == 'queen')
        {
            bishop(parent.data('row'), parent.data('col'))
            rook(parent.data('row'), parent.data('col'))
        }
    }

    //GET PIECE ADVANCEMENT DIRECTION
    const p_adv_dir = () => {
        let p_adv
        if (play_as)
            p_adv = turn ? 0 : 1
        else 
            p_adv = turn ? 1 : 0
        return p_adv

    }

    //CHECK IF EN PASSANT IS AVAILABLE
    const en_passant = (row, col) => {
        const dir = p_adv_dir()
        const adv_check = dir ? -1 : 1
        const l_row = row - 1
        const r_row = row + 1
        const left = $(`.${l_row}-${col}`)
        const right = $(`.${r_row}-${col}`)
        const check_ep_left = left.hasClass('en-passant')
        const check_ep_right = right.hasClass('en-passant')
        
        if(check_ep_left)
        {
            is_ep_curr = true
            show_move(l_row, col + adv_check)
        }
        if(check_ep_right)
        {
            is_ep_curr = true
            show_move(r_row, col + adv_check)
        }
    }

    //ACTIVATE EN PASSANT
    const add_ep = (row, col) => {
        const enemy = turn ? 'p-w' : 'p-b'
        const left = $(`.${row + 1 }-${col}`).find('img')
        const check_ep_left = left.hasClass(enemy) && left.data('id') == 'pawn'
        const right = $(`.${row - 1 }-${col}`).find('img')
        const check_ep_right = right.hasClass(enemy) && right.data('id') == 'pawn'

        if(check_ep_left || check_ep_right)
            $(`.${row}-${col}`).addClass('en-passant')
    }

    //CHECK IF BOX IS EMPTY, HAS A PIECE OR AN ENEMY
    const piece_checker = (row, col) => {
        const e = `.${row}-${col}`
        if($(e).html()){
            if($(`${e} img`).hasClass(`p-${enemy[turn]}`))
                return 2
            else
                return 1
        }
        else
            return 0
    }

    //CLEAR MOVE MARKERS
    const clear_moves = () => {
        $('.possible-move').removeClass('possible-move')
        $('.attack').removeClass('attack')
        
    }

    //SHOW PROMOTION OPTIONS FOR PAWN
    const promotion_options = (color) => {
        on_promotion = true
        const is_below = play_as == color ? '' : 'below'
        const mc = your_color[color]
        console.log(color)
        selected_promotion_square.html(`
        <div class='promotion-options ${is_below}'>
            <div class='promote-to'>
                <img src="piece/${mc}-queen.png" class="p-${mc}" data-id="queen">
            </div>
            <div class='promote-to'>
                <img src="piece/${mc}-rook.png" class="p-${mc}" data-id="rook">
            </div>
            <div class='promote-to'>
                <img src="piece/${mc}-bishop.png" class="p-${mc}" data-id="bishop">
            </div>
            <div class='promote-to'>
                <img src="piece/${mc}-knight.png" class="p-${mc}" data-id="knight">
            </div>
        </div>
        `)
    }

    const is_checked = () => {
        if(turn)
        {
            scan_attacks('w')
        }
        else
        {
            scan_attacks('b')
        }
        return under_attack.includes('king')
    }

    const is_protected = (row, col) => {

    }

    const scan_attacks = (color) => {
        under_attack = []
        ua_rowcol = []
        rowcol_king_threats = []
        piece_protected = []
        const check_dir = p_adv_dir()
        const dir = check_dir ? 1 : -1
        pawn_scan(color, dir)
        console.log(piece_protected)
    }

    const scan_protected = (color) => {

    }

    //PIECE MOVES__________________________________________________________________________

    //PAWN MOVE
    const pawn = (color, row, col) => {
        pawn_move(row, col, play_as, turn)
    }

    const pawn_move = (row, col, dir, turn) => {
        const p_col = dir == turn? col + 1 : col - 1
        const p_col2 = dir == turn ? col + 2 : col - 2
        const p_adv = [2, 7]
        en_passant(row, col)
        if(col == p_adv[p_adv_dir()]){
            if(!piece_checker(row, p_col))
                show_move(row, p_col)
            if(!piece_checker(row, p_col2))
            {
                add_ep(row, p_col2)
                show_move(row, p_col2)
            }
        }
        else{
            if(!piece_checker(row, p_col))
                show_move(row, p_col)
        }
        if(piece_checker(row + 1, p_col) == 2)
            show_attack(row + 1, p_col)
        if(piece_checker(row - 1, p_col) == 2)
            show_attack(row - 1, p_col)
    }

    const pawn_scan = (color, dir) => {
        $(`.p-${color}[data-id=pawn]`).map(function(){
            const e = $(this).parent()
            const row = e.data('row')
            const col = e.data('col')
            if(piece_checker(row - 1 , col + dir) == 1)
            {
                const rowcol = `.${row - 1}-${col + dir}`
                const id = $(rowcol).find('img').data('id')
                under_attack.push(id)
                ua_rowcol.push(rowcol)
                if(id == 'king')
                    rowcol_king_threats.push(`.${row}-${col}`)
            }
            else if(piece_checker(row - 1 , col + dir) == 2)
            {
                piece_protected.push(`.${row - 1 }-${col + dir}`)
            }
            if(piece_checker(row + 1 , col + dir) == 1)
            {
                const rowcol = `.${row + 1}-${col + dir}`
                const id = $(rowcol).find('img').data('id')
                under_attack.push($(id).find('img').data('id'))
                ua_rowcol.push(rowcol)
                if(id == 'king')
                    rowcol_king_threats.push(`.${row}-${col}`)
            }
            else if(piece_checker(row + 1 , col + dir) == 2)
            {
                piece_protected.push(`.${row + 1 }-${col + dir}`)
            }
        })
    }

    //KNIGHT MOVE
    const knight = (row, col) => {
        move_checker(row + 2, col + 1)
        move_checker(row - 2, col - 1)
        move_checker(row + 2, col - 1)
        move_checker(row - 2, col + 1)
        move_checker(row + 1, col + 2)
        move_checker(row - 1, col - 2)
        move_checker(row + 1, col - 2)
        move_checker(row - 1, col + 2)
    }

    //BISHOP MOVE
    const bishop = (row, col) => {
        for(let count = 1 ; count <= 8 ; count ++ )
        {
            if(!move_checker(row + count, col + count))
                count = 9
        }
        for(let count = 1 ; count <= 8 ; count ++ )
        {
            if(!move_checker(row - count, col + count))
                count = 9
        }
        for(let count = 1 ; count <= 8 ; count ++ )
        {
            if(!move_checker(row + count, col - count))
                count = 9
        }
        for(let count = 1 ; count <= 8 ; count ++ )
        {
            if(!move_checker(row - count, col - count))
                count = 9
        }
    }
    
    //ROOK MOVE
    const rook = (row, col) => {
        for(let count = 1 ; count <= 8 ; count ++ )
        {
            if(!move_checker(row + count, col))
                count = 9
        }
        for(let count = 1 ; count <= 8 ; count ++ )
        {
            if(!move_checker(row - count, col))
                count = 9
        }
        for(let count = 1 ; count <= 8 ; count ++ )
        {
            if(!move_checker(row, col + count))
                count = 9
        }
        for(let count = 1 ; count <= 8 ; count ++ )
        {
            if(!move_checker(row, col - count))
                count = 9
        }
    }

    //KING MOVE
    const king = (row, col) => {
        move_checker(row + 1, col)
        move_checker(row - 1, col)
        move_checker(row, col + 1)
        move_checker(row, col - 1)
        move_checker(row -1, col - 1)
        move_checker(row +1, col + 1)
        move_checker(row +1, col - 1)
        move_checker(row -1, col + 1)
    }

    const move_checker = (row, col) => {
        const checker = piece_checker(row, col)
        if(checker == 0)
            show_move(row, col)
        if(checker == 2)
            show_attack(row, col)
        
        if(checker == 1 || checker == 2)
            return false
        else
            return true
    }

    $(document).on('click', '.play', function(){
        const id = $(this).data('id')
        turn = 0
        play_as = id
        reset_board(id)
    })

    $(document).on('click', '.p-b, .p-w', function(){
        const e = $(this)
        const is_move = e.attr('class') == 'p-w' ? 0 : 1
        if(!on_promotion)
        {
            clear_moves()
            if(turn == is_move)
                move_piece(e)
        }
    })

    $(document).on('click', '.possible-move, .attack', function(){
        const e = $(this)
        const is_ep = e.hasClass('en-passant')
        $('.en-passant').removeClass('en-passant')
        if(is_ep)
            e.addClass('en-passant')
        const piece = sel_piece.html()
        const piece_element = sel_piece.find('img')
        const piece_name = piece_element.data('id')
        const is_promote = pawn_promotion_square[0] == e.data('col') || pawn_promotion_square[1] == e.data('col')
        $('.prev-move').removeClass('prev-move')
        clear_moves()
        if(piece_name == 'pawn')
        {
            const prom_sq = piece_element.attr('class') == 'p-w' ? 0 : 1
            if(is_promote){
                selected_promotion_square = e
                promotion_options(prom_sq)
                e.addClass('prev-move')
            }
            else
            {
                const dir = p_adv_dir() ? 1 : -1
                if(is_ep_curr)
                {
                    $(`.${e.data('row')}-${e.data('col') + dir}`).html('')
                    is_ep_curr = false
                }
                sel_piece.html('')
                e.html(piece).addClass('prev-move')
            }
        }
        else
        {
            e.html(piece).addClass('prev-move')
        }
        sel_piece.html('').addClass('prev-move')
        turn = !turn ? 1 : 0
    })

    $(document).on('click', '.promote-to', function(){
        const new_piece = $(this).html()
        selected_promotion_square.html(new_piece)
        $('.promotion-option').remove()
        on_promotion = false
    })
</script>
</html>