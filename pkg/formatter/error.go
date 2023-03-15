package formatter

import (
	"fmt"
	"strings"
)

func Error(es []error) string {
	if len(es) == 1 {
		return fmt.Sprintf("Обнаружена ошибка:\n\t* %s\n\n", es[0])
	}

	points := make([]string, len(es))
	for i, err := range es {
		points[i] = fmt.Sprintf("* %s", err)
	}

	return fmt.Sprintf(
		"%d ошибок обнаружено:\n\t%s\n\n",
		len(es), strings.Join(points, "\n\t"))
}
