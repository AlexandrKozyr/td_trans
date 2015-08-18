
{function name=menu parentId=10001 lvl=1}
    <div class="menu_{$lvl}">    
        <ul>
            {foreach $data[$parentId] as $item}
                {if $item['gotChild'] eq 1}
                    <li class='has-sub'>
                        <a class='has-sub children'>
                            <div class="elements-decoration">
                                {$item['text']}
                                <span class="arrow_menu_font">
                                    >
                                </span>
                            </div>
                        </a>
                        {call name=menu data=$data parentId=$item['id'] lvl=$lvl+1}
                    </li>
                {elseif $item['gotChild'] eq 0}
                    <li class='has-sub'>
                        <a class='has-sub' href='index.php?branchId={$item['id']}&typeId={$typeId}'>
                            <div class="elements-decoration">
                                {$item['text']}
                            </div>
                        </a>
                    </li>
                {/if}
            {/foreach}
        </ul>
    </div>
{/function}
{call name=menu data=$result }   


