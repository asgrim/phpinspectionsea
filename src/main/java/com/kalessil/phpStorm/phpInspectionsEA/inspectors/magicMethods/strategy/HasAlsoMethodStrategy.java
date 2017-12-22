package com.kalessil.phpStorm.phpInspectionsEA.inspectors.magicMethods.strategy;

import com.intellij.codeInspection.ProblemHighlightType;
import com.intellij.codeInspection.ProblemsHolder;
import com.intellij.psi.PsiElement;
import com.jetbrains.php.lang.psi.elements.Method;
import com.jetbrains.php.lang.psi.elements.PhpClass;
import com.kalessil.phpStorm.phpInspectionsEA.utils.NamedElementUtil;
import org.jetbrains.annotations.NotNull;

/*
 * This file is part of the Php Inspections (EA Extended) package.
 *
 * (c) Vladimir Reznichenko <kalessil@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

final public class HasAlsoMethodStrategy {
    private static final String messagePattern = "%s should have pair method %s.";

    static public void apply(@NotNull Method method, @NotNull String companion, @NotNull ProblemsHolder holder) {
        final PhpClass clazz = method.getContainingClass();
        if (clazz != null && clazz.findMethodByName(companion) == null) {
            final PsiElement nameNode = NamedElementUtil.getNameIdentifier(method);
            if (nameNode != null) {
                final String message = String.format(messagePattern, method.getName(), companion);
                holder.registerProblem(nameNode, message, ProblemHighlightType.GENERIC_ERROR);
            }
        }
    }
}
